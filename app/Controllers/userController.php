<?php

namespace App\Controllers;

use \App\Models\userloginModel;

class userController extends BaseController
{
    public $session;
    public $db;
    public $i = 1;
    public function __construct()
    {
        $this->db = db_connect();

        $this->session = session();
    }
    public function index()
    {
        return view("index");
    }
    public function login()
    {
    }

    public function register()
    {
        print_r($this->request->getVar());
        $fname = $this->request->getVar('Fname');
        $Lname = $this->request->getVar('Lname');
        $email = $this->request->getVar('email');
        $ReferId = $this->request->getVar('ReferId');
        $pan = $this->request->getVar('pan');
        $password = md5($this->request->getVar('password'));
        $isValid = [
            'Fname' => 'required',
            'Lname' => 'required',
            'email' => 'required|valid_email|is_unique[userlogin.email]',
            'ReferId' => 'required|exact_length[10]|is_not_unique[userlogin.referralid]',
            'pan' => 'required|exact_length[10]',
            'password' => 'required|min_length[8]|max_length[25]'
        ];
        if ($this->validate($isValid)) {
            $userLogin = new userloginModel();
            $referralid = "DARW";
            $i = false;
            do {
                $referralid .= rand(100000, 999999);
                $result = ($userLogin->where('referralid', $referralid)->findAll());
                if (count($result) > 0) {
                    $i = false;
                }
                // echo $referralid;
                $i = true;
                echo count($result);
            } while ($i == false);
            $data = ['f_name' => $fname, 'l_name' => $Lname, 'email' => $email, 'referralid' => $referralid, 'pancard' => $pan, 'password' => $password, 'referedby' => $ReferId];
            if ($userLogin->insert($data)) {
                $this->session->setFlashdata('success', 'User Registered Successfully');
                return redirect()->back()->withInput();
            } else {
            }
        } else {
            // $this->session->setFlashdata('error',$isValid->getErrors());
            return redirect()->back()->withInput();
        }
        // echo "hello world";
    }



    public function gettotalreferral($id)
    {
        $res = $this->db->query("WITH RECURSIVE referrals AS ( SELECT id, referedby FROM userlogin WHERE id =" . $id . " UNION ALL SELECT u.id, u.referedby FROM userlogin u INNER JOIN userlogin r ON u.referedby = r.id ) SELECT COUNT(*)-1 AS indirect_referral_count FROM referrals;")->getResultArray();
        return $res[0]['indirect_referral_count'];
    }
    public function getdirectreferral($id)
    {
        $res = $this->db->query("select count(*) from userlogin where referedby=" . $id . "")->getResultArray();
        return $directreferral = count($res);
    }


    public function getindirectreferral($id)
    {
        $userController = new userController();
        $total = $userController->gettotalreferral($id);
        $direct = $userController->getdirectreferral($id);
        return $total - $direct;
    }

    public function gettotalreferrall()
    {
        $userloginModel = new userloginModel();


        // to get direct referral 
        $res = $this->db->query("select count(*) from userlogin where referedby=2")->getResultArray();
        $directreferral = count($res);
        //  

        // to get all referrals.
        $res = $this->db->query("WITH RECURSIVE referrals AS ( SELECT id, referedby FROM userlogin WHERE id = 2 UNION ALL SELECT u.id, u.referedby FROM userlogin u INNER JOIN userlogin r ON u.referedby = r.id ) SELECT COUNT(*)-1 AS indirect_referral_count FROM referrals;")->getResultArray();
        //  print_r($res);exit;
        $allreferral = $res[0]['indirect_referral_count'];
        echo "indirect referrals is  =>" . ($allreferral - $directreferral) . " and direct referrals are => " . $directreferral . " and total referrals are=> " . $allreferral;
    }
    public function hello()
    {
        $i = 1;
        $result = 1;
        $query = "SELECT COUNT(*) as total_indirect_referrals 
          FROM (";
        while ($i < 13) {
            $query .= "SELECT t.id as root_id, t" . $i + 1 . ".id as referral_id, t" . $i + 1 . ".referred_by
            FROM users t1
            JOIN users t" . $i + 1 . " ON t" . $i . ".id = t" . $i + 1 . ".referred_by UNION ALL ";

            //  $res = $this->db->query("SELECT COUNT(*) as total_indirect_referrals 
            //  FROM (
            //    SELECT t.id as root_id, t2.id as referral_id, t2.referred_by
            //    FROM users t1
            //    JOIN users t2 ON t1.id = t2.referred_by
            //    UNION ALL
            //    SELECT t1.id as root_id, t3.id as referral_id, t3.referred_by
            //    FROM users t1
            //    JOIN users t2 ON t1.id = t2.referred_by
            //    JOIN users t3 ON t2.id = t3.referred_by
            //    UNION ALL
            //    SELECT t1.id as root_id, t4.id as referral_id, t4.referred_by
            //    FROM users t1
            //    JOIN users t2 ON t1.id = t2.referred_by
            //    JOIN users t3 ON t2.id = t3.referred_by
            //    JOIN users t4 ON t3.id = t4.referred_by
            //    -- continue adding joins for more levels of referrals
            //  ) t
            //  WHERE t.root_id = 1;")->getResultArray();
            //  $result+= count($res);
            $i++;
        }
        echo $query;
    }

    public function homepage()
    {
        $isvalid = ['id' => 'is_not_unique[userlogin.id]|integer'];

        if ($this->request->getMethod() == "post") {
            if ($this->validate($isvalid)) {
                $id = $this->request->getVar()['id'];
                $userloginModel = new userloginModel();
                $userController = new userController();
                $indi = $userController->getindirect($id);
                // echo "<pre>";
                $level = ($userController->getlevelcountByid($id));
                
                // print_r($userController->getDirectCommission($level[1]['level']));
                // exit;
                // exit;
                $tree = ($userController->generateTree($id));
                // exit;


                // to get direct referral 
                $res = $this->db->query("select count(*) from userlogin where referedby=" . $id)->getResultArray();
                // print_r($res[0]['count(*)']);exit;
                $directreferral = $res[0]['count(*)'];
                //  

                // to get all referrals.
                $res = $this->db->query("WITH RECURSIVE referrals AS ( SELECT id, referedby FROM userlogin WHERE id = " . $id . " UNION ALL SELECT u.id, u.referedby FROM userlogin u INNER JOIN userlogin r ON u.referedby = r.id ) SELECT * FROM referrals where id>" . $id . ";")->getResultArray();
                $indirect= $this->db->query("WITH RECURSIVE subchilds AS (
                    SELECT id, referedby, email FROM userlogin WHERE id = $id
                    UNION ALL
                    SELECT u.id, u.referedby, u.email FROM userlogin u
                    JOIN subchilds s ON u.referedby = s.id
                    WHERE u.id !=$id AND u.referedby != s.referedby
                )
                SELECT COUNT(*) AS TOTAL FROM subchilds where id!= $id AND referedby !=$id;")->getResultArray();
                //  print_r($indirect);exit;
                $allreferral = count($res);
                // echo "total " . $allreferral;
                // print_r($res);
                // exit;
                return view('homepage', ['totalreferral' => ($directreferral+$indirect[0]['TOTAL']) , 'indirectreferral' => ($indirect[0]['TOTAL']), 'directreferral' => $directreferral, 'tree' => $tree, 'id' => $id, 'level' => $level]);
                // echo "indirect referrals is  =>" . ($allreferral - $directreferral) . " and direct referrals are => " . $directreferral . " and total referrals are=> " . $allreferral;
                // echo ($id);
            } else {
                echo "<div class='text-danger'><b><h2>Wrong ID</h2></b></div>";
            }
        }
        return view('homepage');
    }
    function getindirect($parentId)
    {
        $result = $this->db->query("SELECT id, f_name, l_name, email FROM userlogin WHERE referedby = $parentId")->getResultArray();

        // If there are no children, return an empty string
        if (count($result) == 0) {
            return '';
        }

        // Otherwise, start a new nested list
        $output = '<ul class="tree vertical">';
        $userController = new userController();
        // Loop through the children and add each one to the list
        foreach ($result as $row) {
            // print_r($row);
            // echo "<br>";
            $output .= '<li><div>' . $row['f_name'] . $this->i . '                 </div>       ';
            $output .= $userController->generateTree($row['id']);
            $output .= '</li>';
            $this->i++;
        }

        // Close the nested list
        $output .= '</ul>';

        // Return the generated HTML
        return $this->i;
    }


    function generateTree($parentId)
    {

        $result = $this->db->query("SELECT id, f_name, l_name, email FROM userlogin WHERE referedby = $parentId")->getResultArray();

        // If there are no children, return an empty string
        if (count($result) == 0) {
            return '';
        }

        // Otherwise, start a new nested list
        $output = '<ul class="tree vertical bg-info">';
        $userController = new userController();
        // Loop through the children and add each one to the list
        foreach ($result as $row) {
            // print_r($row);
            // echo "<br>";
            $output .= '<li><div>' . $row['id'] . '                  </div>       ';
            $output .= $userController->generateTree($row['id']);
            $output .= '</li>';
            $this->i++;
        }

        // Close the nested list
        $output .= '</ul>';

        // Return the generated HTML
        return $output;
    }



    function getlevelcountByid($id)
    {
        return $this->db->query("WITH RECURSIVE referrals AS (
            SELECT id, referedby, 1 as level 
            FROM userlogin 
            WHERE id = $id
            UNION ALL 
            SELECT u.id, u.referedby, r.level + 1 as level 
            FROM userlogin u 
            INNER JOIN referrals r ON u.referedby = r.id 
          ) 
          SELECT level,id, COUNT(*) AS node_count 
          FROM referrals WHERE id <> $id
          GROUP BY level;")->getResultArray();
    }
    function getDirectCommission($totall)
    {
        $result=0;
        for ($i = 0; $i < $totall; $i++) {

            $amount = 12500; // Replace with the actual amount

            $commission = $amount * 0.05; // Calculate the commission

            $total = $amount - $commission; // Calculate the total after deducting the commission

            echo "Amount: $" . number_format($amount, 2) . "<br>";
            echo "Commission (5%): $" . number_format($commission, 2) . "<br>";       
            echo "Total: $" . number_format($total, 2) . "<br>";
            $result+=intval(number_format($total, 2));
        }
        echo "Total Count of referrals". $totall . "<br>";
        echo "Result here->". $result . "<br>";
    }
}

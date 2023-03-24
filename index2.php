<!-- <?php
// // Database connection parameters
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "referral";

// // Connect to database
// $connection = mysqli_connect($servername, $username, $password, $dbname);

// // Check connection
// if (!$connection) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// // Function to calculate the commission for a given referral
// function calculateCommission($referralDepth) {
//     if ($referralDepth == 0) {
//       return 0.05;
//     } elseif ($referralDepth == 1) {
//       return 0.04;
//     } elseif ($referralDepth == 2) {
//       return 0.03;
//     } else {
//       return 0.02;
//     }
//   }
  
//   // Function to get the direct referrals for a given user
//   function getDirectReferrals($userId, $conn) {
//     $query = "SELECT * FROM referrals WHERE referring_user_id = $userId AND depth = 0";
//     $result = mysqli_query($conn, $query);
//     return $result;
//     print_r(mysqli_fetch_assoc($result));
//   }
  
//   // Function to get the indirect referrals for a given user
//   function getIndirectReferrals($userId, $conn) {
//     $query = "SELECT * FROM referrals WHERE referring_user_id = $userId AND depth > 0";
//     $result = mysqli_query($conn, $query);
//     return $result;
//   }
//   print_r(getDirectReferrals(1,$connection));



// function calculateReferralPercentage($referralLevel)
// {
//     switch ($referralLevel) {
//         case 1:
//             return 5; // 5% for first 6 direct referrals
//         case 2:
//             return 4; // 4% for next 6 indirect referrals
//         default:
//             return 3; // 3% for referrals beyond the first 2 tiers
//     }
// }


// // Function to generate a unique referral code
// function generateReferralCode()
// {
//     $length = 8;
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }

// // Function to add a referral
// function addReferral($referrerID, $referredID, $referralLevel, $referralCode)
// {
//     // Database connection parameters
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "referral";

//     // Connect to database
//     $connection = mysqli_connect($servername, $username, $password, $dbname);

//     // Check connection
//     if (!$connection) {
//         die("Connection failed: " . mysqli_connect_error());
//     }

//     $referralPercentage = calculateReferralPercentage($referralLevel);
//     $query = "INSERT INTO referrals (referrer_id, referred_id, referral_code, referral_level, referral_percentage) VALUES ('$referrerID', '$referredID', '$referralCode', '$referralLevel', '$referralPercentage')";
//     $result = mysqli_query($connection, $query);
//     if ($result) {
//         return true;
//     } else {
//         return false;
//     }
// }

// // Function to accept a referral
// function acceptReferral($referralID)
// {
//     // Database connection parameters
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "referral";

//     // Connect to database
//     $connection = mysqli_connect($servername, $username, $password, $dbname);

//     // Check connection
//     if (!$connection) {
//         die("Connection failed: " . mysqli_connect_error());
//     }
//     $query = "UPDATE referrals SET referral_status = 'Accepted' WHERE referral_id = '$referralID'";
//     $result = mysqli_query($connection, $query);
//     if ($result) {
//         return true;
//     } else {
//         return false;
//     }
// }

// // Function to reject a referral
// function rejectReferral($referralID)
// {
//     // Database connection parameters
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "referral";

//     // Connect to database
//     $connection = mysqli_connect($servername, $username, $password, $dbname);

//     // Check connection
//     if (!$connection) {
//         die("Connection failed: " . mysqli_connect_error());
//     }
//     $query = "UPDATE referrals SET referral_status = 'Rejected' WHERE referral_id = '$referralID'";
//     $result = mysqli_query($connection, $query);
//     if ($result) {
//         return true;
//     } else {
//         return false;
//     }
// }

// // Function to get the referrals for a user
// function getReferrals($userID)
// {
//     // Database connection parameters
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "referral";

//     // Connect to database
//     $connection = mysqli_connect($servername, $username, $password, $dbname);

//     // Check connection
//     if (!$connection) {
//         die("Connection failed: " . mysqli_connect_error());
//     }
//     $query = "SELECT * FROM referrals WHERE referrer_id = '$userID'";
//     $result = mysqli_query($connection, $query);
//     $referrals = array();
//     while ($row = mysqli_fetch_assoc($result)) {
//         $referrals[] = $row;
//     }
//     return $referrals;
// }

// // Function to calculate the total referral commission earned by a user
// function calculate_referral_commission($user_id)
// {
//     // Get all referrals of the user
//     $referrals = get_all_referrals($user_id);

//     // Calculate the total commission earned by the user
//     $total_commission = 0;
//     foreach ($referrals as $referral) {
//         $referral_percentage = $referral['referral_percentage'];
//         $referred_user_id = $referral['referred_id'];

//         // Check if the referred user is a direct or indirect referral
//         $is_direct_referral = $referral['referral_level'] == 1;

//         // Get the commission earned by the referral
//         $commission_earned = calculate_referral_commission_for_user($referred_user_id, $referral_percentage, $is_direct_referral);

//         // Add the commission earned to the total commission
//         $total_commission += $commission_earned;
//     }

//     return $total_commission;
// }

// // Function to get all referrals of a user
// function get_all_referrals($user_id)
// {
//     // Database connection parameters
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "referral";

//     // Connect to database
//     $connection = mysqli_connect($servername, $username, $password, $dbname);

//     // Check connection
//     if (!$connection) {
//         die("Connection failed: " . mysqli_connect_error());
//     }
//     // Initialize an array to store the referrals
//     $referrals = array();

//     // Get the direct referrals of the user
//     $query = "SELECT * FROM referrals WHERE referrer_id = '$user_id' AND referral_level = 1";
//     $result = mysqli_query($connection, $query);
//     while ($row = mysqli_fetch_assoc($result)) {
//         $referrals[] = $row;
//     }

//     // Get the indirect referrals of the user
//     // $query = "SELECT r.* FROM referrals r JOIN users u ON r.referred_id = u.id WHERE u.referrer_id = '$user_id' AND r.referral_level > 1";
//     // $result = mysqli_query($connection, $query);
//     // while ($row = mysqli_fetch_assoc($result)) {
//     //     $referrals[] = $row;
//     // }

//     // Return the referrals
//     return $referrals;
// }

// // Function to calculate the referral commission earned by a user for a specific referral percentage
// function calculate_referral_commission_for_user($user_id, $referral_percentage, $is_direct_referral)
// {
//     // Calculate the total amount spent by the user
//     // $total_spent = calculate_total_spent($user_id);

//     // // Calculate the commission earned by the user
//     // if ($is_direct_referral) {
//     //     // Direct referral commission
//     //     $commission_earned = ($total_spent * $referral_percentage) / 100;
//     // } else {
//     //     // Indirect referral commission
//     //     $commission_earned = ($total_spent * $referral_percentage) / 100;
//     // }

//     // return $commission_earned;
// }

// Function to calculate the total amount spent by a user
// function calculate_total_spent($user_id)
// {
//     // Database connection parameters
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "referral";

//     // Connect to database
//     $connection = mysqli_connect($servername, $username, $password, $dbname);

//     // Check connection
//     if (!$connection) {
//         die("Connection failed: " . mysqli_connect_error());
//     }
//     // Query to get the total amount spent by the user
//     $query = "SELECT SUM(amount) AS total_spent FROM purchases WHERE user_id = '$user_id'";

//     // Execute the query
//     $result = mysqli_query($connection, $query);

//     // Get the total amount spent by the user
//     $row = mysqli_fetch_assoc($result);
//     $total_spent = $row['total_spent'];

//     // Return the total amount spent by the user
//     return $total_spent;
// }


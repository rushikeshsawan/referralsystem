<?php

// Define a function to generate the nested list
function generateTree($parentId) {
  // Query the database to get the children of the parent node
  $query = "SELECT id, f_name, l_name, email FROM userlogin WHERE referedby = $parentId";
  $result = mysqli_query($connection, $query);
  
  // If there are no children, return an empty string
  if (mysqli_num_rows($result) == 0) {
    return '';
  }
  
  // Otherwise, start a new nested list
  $output = '<ul>';
  $i=0;
  // Loop through the children and add each one to the list
  while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<li>' . $row['f_name'] . $i . $row['l_name'] . ' (' . $row['email'] . ')';
    $output .= generateTree($row['id']);
    $output .= '</li>';
    $i++;
  }
  
  // Close the nested list
  $output .= '</ul>';
  
  // Return the generated HTML
  return $output;
}

// Call the function to generate the tree starting from the top-level node
echo generateTree([top_tree_node_id]);

?>

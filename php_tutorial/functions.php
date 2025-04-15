<?php
function sum($a, $b){

    $b = $a +$b;
    return $b;
    }
    $sum = sum(10, 20);
    echo $sum;
    echo"<br>";
    function sub($math, $eng, $science){
        $avg = $math + $eng + $science;
        return $avg;
    }
    $total = sub(30, 40, 50);
     function percentage($total){
        $percentage = $total/3;
        return $percentage;
     }
     echo percentage($total);



     echo "<br> Reccursive function";


function display($number) {
    if ($number == 1) { // Base case
        return 1;
    } else {
        return $number * display($number - 1); // Recursive case
    }
}

echo display(5); // Output: 120
echo "<br> Array ";

$colors =['Red', 30, 'blue', 'cvishwanath'];
for($i = 0; $i<4; $i++){

    echo $colors[$i]."<br>";
}

//associative array
$arr = [
    "a"=>200,
    "b"=>300,
    "c"=>400,
    "d"=>500,

];
foreach($arr as $key=>$ar){
    echo"Name"." ".$key." "."Expenses".$ar."<br>";
}

echo "<br> Multidimensional Array";

$categories = [
    "Electronics" => [
        "Phones" => ["iPhone", "Samsung Galaxy", "Google Pixel"],
        "Laptops" => ["MacBook", "Dell XPS", "HP Spectre"]
    ],
    "Furniture" => [
        "Chairs" => ["Office Chair", "Gaming Chair", "Recliner"],
        "Tables" => ["Dining Table", "Coffee Table", "Bedside Table"]
    ],
    "Furnituress" => [
        "Chairss" => ["Office Chair", "Gaming Chair", "Recliner"],
        "Tabless" => ["Dining Table", "Coffee Table", "Bedside Table"]
    ]
];

echo $categories["Electronics"]["Phones"][1].'<br>'; // Outputs: Samsung Galaxy

foreach ($categories as $category => $subcategories) {
    echo "<strong>$category:</strong><br>";
    foreach ($subcategories as $subcategory => $items) {
        echo "- $subcategory: ";
        foreach ($items as $item) {
            echo $item . " ";
        }
        echo "<br>";
    }
    echo "<br>";
}
//associative array syntax
echo "<br>";
$array = array(
    "a"=>25,
    "b"=>23335,
    "c"=>235,
    "d"=>325,
    "e"=>525,


);
echo$array['c'];
echo "<br>";
// foreach($array as $value){
//     echo $value
// }
// when array is associative 
$ages = [
    'vish' => 25,
    'vish2' => 26,
    'vish3' => 27,
    'vish4' => 28,
];
foreach($ages as $agekey=>$value){
    echo $agekey." "." ".$value."<br>";
}
//multidimensional array..............

$Employes = [
    [1, 'vish', 'Engineer', 40000],
    [2, 'abc', 'Salesman', 41000],
    [3, 'def', 'Tester', 42000],
    [4, 'vish2', 'System Analyst', 43000],
    [5, 'vish4', 'Devop', 44000],
    [6, 'vish5', 'WebDesigner', 45000],
    [7, 'vish7', 'WebDeveloper', 46000],
];

// Loop through all employees
for ($row = 0; $row < count($Employes); $row++) {
    // Loop through each employee's details (ID, Name, Designation, Salary)
    for ($col = 0; $col < count($Employes[$row]); $col++) {
        echo $Employes[$row][$col] . " ";
    }
    echo "<br>";
}
echo "<br> <br>";
echo "<h2>Foreach loop for an Associative Array</h2>";
echo "<br> <br>";
echo"<table border='2px' cellpadding='2px'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Designation</th>";
echo "<th>Salary</th>";
echo "</tr>";

foreach($Employes as $emp){
    // echo $emp[0]."<br>";
    echo "<tr>";
    foreach($emp as $value){
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo"<table>";

// multidimmensional associative array
echo "<br><h2>multidimmensional associative array</h2>";

$students = [
    'student1' => [
        'name' => 'Vish',
        'subjects' => [
            'Physics' => 85,
            'Chemistry' => 78,
            'Mathematics' => 92,
            'Biology' => 74,
            'English' => 88
        ]
    ],
    'student2' => [
        'name' => 'ABC',
        'subjects' => [
            'Physics' => 90,
            'Chemistry' => 81,
            'Mathematics' => 87,
            'Biology' => 76,
            'English' => 84
        ]
    ],
    'student3' => [
        'name' => 'DEF',
        'subjects' => [
            'Physics' => 79,
            'Chemistry' => 85,
            'Mathematics' => 88,
            'Biology' => 82,
            'English' => 91
        ]
    ]
];
// HTML table starts here
echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; text-align: center;'>
        <tr>
            <th>Name</th>
            <th>Subject</th>
            <th>Marks</th>
        </tr>";

// Loop through students to populate table rows
foreach ($students as $student) {
    $name = $student['name'];
    $subjects = $student['subjects'];
    $firstSubject = true; // To merge the Name cell only once

    foreach ($subjects as $subject => $marks) {
        echo "<tr>";

        // Display the name only in the first subject row
        if ($firstSubject) {
            echo "<td rowspan='" . count($subjects) . "'>$name</td>";
            $firstSubject = false;
        }

        echo "<td>$subject</td>";
        echo "<td>$marks</td>";

        echo "</tr>";
    }
}

echo "</table>";
echo "<br><br>";
?>
<table  border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; text-align: center;'>
    <?php
    $number = 1; // Start from 1

    for ($row = 1; $row <= 10; $row++) { // Outer loop for rows
        echo "<tr>";
        for ($col = 1; $col <= 10; $col++) { // Inner loop for columns
            echo "<td>$number</td>";
            $number++; // Increment number
        }
        echo "</tr>";
    }
    ?>
</table>
<?php $test_arrays = [
    [1, "John", "Doe", "Software Engineer", "Backend Developer"],
    [2, "Jane", "Smith", "Project Manager", "Scrum Master"],
    [3, "Alice", "Brown", "Data Scientist", "Machine Learning"],
    [4, "Bob", "Johnson", "Frontend Developer", "React Specialist"],
    [5, "Charlie", "Davis", "UI/UX Designer", "Product Designer"],
    [6, "Emily", "White", "DevOps Engineer", "Cloud Architect"],
    [7, "Frank", "Harris", "Cybersecurity Analyst", "Penetration Tester"],
    [8, "Grace", "Miller", "Mobile Developer", "Flutter Expert"],
    [9, "Henry", "Wilson", "Database Administrator", "SQL Specialist"],
    [10, "Ivy", "Taylor", "Full Stack Developer", "MERN Stack"],
];  ?>
<table  border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; text-align: center;'>
<tr>
   
   <td>Id</td>
   <td>First Name</td>
   <td>Last Name</td>
   <td>Designation</td>
   <td>Post</td>
  
</tr>
<tbody>
<?php
foreach ($test_arrays as $test_key => $test_value) {
    echo "<tr>";
     foreach($test_value as $value){
        
        echo "<td>";
        echo $value;
        echo "</td>";
     }
    echo "</tr>";

    
}
echo "</tbody>";
echo "</table>";

$employees = [
    [
        "id" => 1,
        "first_name" => "John",
        "last_name" => "Doe",
        "position" => "Software Engineer",
        "department" => "Backend Development",
        "skills" => ["PHP", "Laravel", "MySQL", "API Development"],
        "projects" => [
            ["name" => "E-commerce Platform", "year" => 2023],
            ["name" => "HR Management System", "year" => 2024]
        ]
    ],
    [
        "id" => 2,
        "first_name" => "Jane",
        "last_name" => "Smith",
        "position" => "Project Manager",
        "department" => "Agile Team",
        "skills" => ["Scrum", "Kanban", "JIRA", "Communication"],
        "projects" => [
            ["name" => "Company Website Redesign", "year" => 2023],
            ["name" => "Mobile App Development", "year" => 2024]
        ]
    ],
    [
        "id" => 3,
        "first_name" => "Alice",
        "last_name" => "Brown",
        "position" => "Data Scientist",
        "department" => "AI & Machine Learning",
        "skills" => ["Python", "TensorFlow", "Big Data", "Statistics"],
        "projects" => [
            ["name" => "AI Chatbot", "year" => 2022],
            ["name" => "Fraud Detection System", "year" => 2024]
        ]
    ],
    [
        "id" => 4,
        "first_name" => "Bob",
        "last_name" => "Johnson",
        "position" => "Frontend Developer",
        "department" => "UI/UX",
        "skills" => ["JavaScript", "React", "CSS", "UI Design"],
        "projects" => [
            ["name" => "Admin Dashboard", "year" => 2023],
            ["name" => "Customer Portal", "year" => 2024]
        ]
    ],
    [
        "id" => 5,
        "first_name" => "Charlie",
        "last_name" => "Davis",
        "position" => "UI/UX Designer",
        "department" => "Design Team",
        "skills" => ["Adobe XD", "Figma", "Sketch", "Prototyping"],
        "projects" => [
            ["name" => "Brand Identity", "year" => 2022],
            ["name" => "Mobile App UI", "year" => 2024]
        ]
    ]
];
?>
<table  border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; text-align: center;'>

   <td>Id</td>
   <td>Name</td>
   <td>Position</td>
   <td>Skills</td>
   <td>Projects</td>
  
</tr>
<tbody>
  <tr>
     <?php
foreach($employees as $employee_value){
   echo "<tr>";
    echo "<td>".$employee_value['id']."</td>";
echo "<td>".$employee_value['first_name']."</td>";
echo "<td>".$employee_value['position']."</td>";
 $skill = implode(', ',$employee_value['skills']);
 echo "<td>".$skill."</td>";
 echo "<td>";
 foreach($employee_value['projects'] as $project_value){
// $project = implode(',' , $project_value[]);

echo $project_value['name'].", ";
echo $project_value['year'].", ";

}
echo "</td>";
   
echo "</tr>";
}
?>
 
</tbody>
</table>









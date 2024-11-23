<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123'; 
$dbname = 'world'; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $country = isset($_GET['country']) ? $_GET['country'] : '';

    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => "%$country%"]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<table border='1' style='width: 100%; text-align: center; border-collapse: collapse;'>";
        echo "<thead>
                <tr>
                    <th>Name</th>
                    <th>Continent</th>
                    <th>Independence</th>
                    <th>Head of State</th>
                </tr>
              </thead>";
        echo "<tbody>";
        
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['continent']) . "</td>
                    <td>" . htmlspecialchars($row['independence_year'] ? $row['independence_year'] : 'N/A') . "</td>
                    <td>" . htmlspecialchars($row['head_of_state'] ? $row['head_of_state'] : 'N/A') . "</td>
                  </tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No results found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

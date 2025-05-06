require 'vendor/autoload.php';

use PhpCrud\Crud;

$db = new Crud('localhost', 'root', '', 'your_db');

// Create
$db->create('users', ['name' => 'John', 'email' => 'john@example.com']);

// Read
$result = $db->read('users');
while ($row = $result->fetch_assoc()) {
echo $row['name'] . "<br>";
}

// Update
$db->update('users', ['name' => 'Johnny'], "id=1");

// Delete
$db->delete('users', "id=1");
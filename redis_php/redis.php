use Predis\Client;

<?php
// Include the Predis autoloader
require 'vendor/autoload.php';


// Create a new Redis client
$redis = new Client();

// Create
function create($key, $value) {
    global $redis;
    $redis->set($key, $value);
    echo "Created key: $key with value: $value\n";
}

// Read
function read($key) {
    global $redis;
    $value = $redis->get($key);
    echo "Read key: $key with value: $value\n";
    return $value;
}

// Update
function update($key, $newValue) {
    global $redis;
    if ($redis->exists($key)) {
        $redis->set($key, $newValue);
        echo "Updated key: $key with new value: $newValue\n";
    } else {
        echo "Key: $key does not exist\n";
    }
}

// Delete
function delete($key) {
    global $redis;
    if ($redis->exists($key)) {
        $redis->del($key);
        echo "Deleted key: $key\n";
    } else {
        echo "Key: $key does not exist\n";
    }
}

// Example usage
create('name', 'John Doe');
read('name');
update('name', 'Jane Doe');
delete('name');
?>
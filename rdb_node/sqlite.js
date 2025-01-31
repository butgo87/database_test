const sqlite3 = require('sqlite3').verbose();

// Open a database connection
let db = new sqlite3.Database('./database.db', (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Connected to the SQLite database.');
});

// Create a new table
db.run(`CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT
)`);

// Insert a new user
db.run(`INSERT INTO users (name, email) VALUES (?, ?)`, ['John Doe', 'john.doe@example.com'], function(err) {
    if (err) {
        return console.error(err.message);
    }
    console.log(`A row has been inserted with rowid ${this.lastID}`);
});

// Read all users
db.all(`SELECT * FROM users`, [], (err, rows) => {
    if (err) {
        throw err;
    }
    rows.forEach((row) => {
        console.log(row);
    });
});

// Update a user
db.run(`UPDATE users SET name = ? WHERE id = ?`, ['Jane Doe', 1], function(err) {
    if (err) {
        return console.error(err.message);
    }
    console.log(`Row(s) updated: ${this.changes}`);
});

// Delete a user
db.run(`DELETE FROM users WHERE id = ?`, [1], function(err) {
    if (err) {
        return console.error(err.message);
    }
    console.log(`Row(s) deleted: ${this.changes}`);
});

// Close the database connection
db.close((err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Close the database connection.');
});

function executeDatabaseOperations() {

    // Open a database connection
    let db = new sqlite3.Database('./database.db', (err) => {
        if (err) {
            console.error(err.message);
        }
        console.log('Connected to the SQLite database.');
    });

    // Create a new table
    db.run(`CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        email TEXT
    )`);

    // Insert a new user
    db.run(`INSERT INTO users (name, email) VALUES (?, ?)`, ['John Doe', 'john.doe@example.com'], function(err) {
        if (err) {
            return console.error(err.message);
        }
        console.log(`A row has been inserted with rowid ${this.lastID}`);
    });

    // Read all users
    db.all(`SELECT * FROM users`, [], (err, rows) => {
        if (err) {
            throw err;
        }
        rows.forEach((row) => {
            console.log(row);
        });
    });

    // Update a user
    db.run(`UPDATE users SET name = ? WHERE id = ?`, ['Jane Doe', 1], function(err) {
        if (err) {
            return console.error(err.message);
        }
        console.log(`Row(s) updated: ${this.changes}`);
    });

    // Delete a user
    db.run(`DELETE FROM users WHERE id = ?`, [1], function(err) {
        if (err) {
            return console.error(err.message);
        }
        console.log(`Row(s) deleted: ${this.changes}`);
    });

    // Close the database connection
    db.close((err) => {
        if (err) {
            console.error(err.message);
        }
        console.log('Close the database connection.');
    });
}

executeDatabaseOperations();
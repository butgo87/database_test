@Grab(group='org.xerial', module='sqlite-jdbc', version='3.34.0')
import groovy.sql.Sql

class SQLiteDB {
    private Sql sql

    SQLiteDB(String dbPath) {
        sql = Sql.newInstance("jdbc:sqlite:$dbPath", "org.sqlite.JDBC")
    }

    void createTable() {
        sql.execute '''
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE
            )
        '''
    }

    void insertUser(String name, String email) {
        sql.execute 'INSERT INTO users (name, email) VALUES (?, ?)', [name, email]
    }

    List<Map> getUsers() {
        sql.rows('SELECT * FROM users')
    }

    void updateUser(int id, String name, String email) {
        sql.execute 'UPDATE users SET name = ?, email = ? WHERE id = ?', [name, email, id]
    }

    void deleteUser(int id) {
        sql.execute 'DELETE FROM users WHERE id = ?', [id]
    }

    void close() {
        sql.close()
    }
}

// Usage example
def db = new SQLiteDB('test.db')
db.createTable()
db.insertUser('John Doe', 'john.doe@example.com')
db.insertUser('Jane Smith', 'jane.smith@example.com')

println db.getUsers()

db.updateUser(1, 'John Doe', 'john.newemail@example.com')
println db.getUsers()

db.deleteUser(2)
println db.getUsers()

db.close()
import sqlite3

def create_connection(db_file):
    conn = None
    try:
        conn = sqlite3.connect(db_file)
        return conn
    except sqlite3.Error as e:
        print(e)
    return conn

def create_table(conn):
    try:
        sql_create_table = """ CREATE TABLE IF NOT EXISTS users (
                                    id integer PRIMARY KEY,
                                    name text NOT NULL,
                                    age integer
                                ); """
        conn.execute(sql_create_table)
    except sqlite3.Error as e:
        print(e)

def insert_user(conn, user):
    sql = ''' INSERT INTO users(name, age)
              VALUES(?,?) '''
    cur = conn.cursor()
    cur.execute(sql, user)
    conn.commit()
    return cur.lastrowid

def select_all_users(conn):
    cur = conn.cursor()
    cur.execute("SELECT * FROM users")
    rows = cur.fetchall()
    for row in rows:
        print(row)

def update_user(conn, user):
    sql = ''' UPDATE users
              SET name = ? ,
                  age = ?
              WHERE id = ?'''
    cur = conn.cursor()
    cur.execute(sql, user)
    conn.commit()

def delete_user(conn, id):
    sql = 'DELETE FROM users WHERE id=?'
    cur = conn.cursor()
    cur.execute(sql, (id,))
    conn.commit()

def main():
    database = r"test.db"

    conn = create_connection(database)
    if conn is not None:
        create_table(conn)

        user_1 = ('John', 25)
        user_2 = ('Anna', 30)

        insert_user(conn, user_1)
        insert_user(conn, user_2)

        print("Users before update:")
        select_all_users(conn)

        update_user(conn, ('John Doe', 26, 1))

        print("Users after update:")
        select_all_users(conn)

        delete_user(conn, 2)

        print("Users after deletion:")
        select_all_users(conn)

        conn.close()
    else:
        print("Error! Cannot create the database connection.")

if __name__ == '__main__':
    main()
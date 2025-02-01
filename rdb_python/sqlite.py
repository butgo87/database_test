import sqlite3
import os
from dotenv import load_dotenv

conn = None


def create_connection():

    load_dotenv("../.env")
    sqlitedb = os.getenv("SQLITEDB")
    print("sqlitedb : " + sqlitedb)
    global conn
    try:
        conn = sqlite3.connect("../" + sqlitedb)
        print("Connection is established: Database is created on file " + sqlitedb)
    except sqlite3.Error as e:
        print(e)

def create_table():
    try:
        sql = """ CREATE TABLE IF NOT EXISTS user (
                        user_id varchar(10)
                      , first_name varchar(50)
                      , last_name varchar(50)
                      , age integer
                      , CONSTRAINT pk_user PRIMARY KEY (user_id)
                  ); """
        print("sql: " + sql)
        conn.execute(sql)
    except sqlite3.Error as e:
        print(e)
        raise e

def read_data():
    try:
        sql = """ SELECT
                          user_id
                        , first_name
                        , last_name
                        , age
                    FROM
                       user """
        print("sql: " + sql)
        cur = conn.cursor()
        cur.execute(sql)
        rows = cur.fetchall()
        print("rows: ", rows)
        for row in rows:
            print("row: " + row)
    except sqlite3.Error as e:
        print(e)
        raise e

def main():
    print("Hello, World!")
    create_connection()

    create_table()
    read_data()


if __name__ == "__main__":
    main()

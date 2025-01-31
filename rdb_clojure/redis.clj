(ns redis
    (:require [clojure.java.jdbc :as jdbc]))

(def db-spec {:classname   "org.sqlite.JDBC"
                            :subprotocol "sqlite"
                            :subname     "db.sqlite"})

(defn create-table []
    (jdbc/execute! db-spec ["CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT, age INTEGER)"]))

(defn insert-user [name age]
    (jdbc/insert! db-spec :users {:name name :age age}))

(defn get-user [id]
    (jdbc/query db-spec ["SELECT * FROM users WHERE id = ?" id]))

(defn update-user [id name age]
    (jdbc/update! db-spec :users {:name name :age age} ["id = ?" id]))

(defn delete-user [id]
    (jdbc/delete! db-spec :users ["id = ?" id]))

;; Example usage
(create-table)
(insert-user "Alice" 30)
(println (get-user 1))
(update-user 1 "Alice" 31)
(delete-user 1)
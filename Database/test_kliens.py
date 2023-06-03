from mongo_connection import choose_database

database_key = "sql"

username = 'John Doe'
email = 'john@ljb.vd'
password = 'valami'

database = choose_database(database_key,username,email,password)


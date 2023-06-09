import mysql.connector
from pymongo import MongoClient
from sql_kliens import *
from mongo_kliens import *



# Adatbázis kulcs alapján történő választás
def choose_database(key,username,email,password):
    if key == "sql":
        sql_open_con()
        # POST
        # ÚJ KLIENS LÉTREHOZÁSA
        sql_post_new_client(username, email, password)

        # GET
        # KLIENS LEKÉRÉSE ID ALAPJÁN
        id = 1
        print(sql_get_client_by_id(id))

        # KLIENS LEKÉRÉSE EMAIL ALAPJÁN
        email = 'jancsi@ljb.vd'
        print(sql_get_client_by_email(email))

        # Szavazat rögzítése

        voter_name = "Lajos"
        vote = "Meg semmit."
        kerdes = "Mit ittal ma?"

        sql_record_vote(voter_name,vote,kerdes)

        result = sql_get_vote_by_voter("John Doe")
        print(result)

    elif key == "mongodb":
        # MongoDB adatbázis kapcsolat inicializálása
        mongo_open_con()
        # POST
        # ÚJ KLIENS LÉTREHOZÁSA
        mongo_post_new_client(username, email, password)

        # GET
        # KLIENS LEKÉRÉSE ID ALAPJÁN
        id = 1
        print(mongo_get_client_by_id(id))

        # KLIENS LEKÉRÉSE EMAIL ALAPJÁN
        email = 'jancsi@ljb.vd'
        print(mongo_get_client_by_email(email))
        # Szavazat rögzítése

        voter_name = "John Doe"
        vote = "A"

        mongo_record_vote(voter_name,vote)

        result = mongo_get_vote_by_voter("John Doe")
        print(result)
    else:
        print("Érvénytelen adatbázis kulcs.")
        return None

# Példa adatbázis használatra kulcs alapján
# database_key = "sql"





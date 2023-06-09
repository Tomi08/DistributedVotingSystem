from pymongo import MongoClient

def mongo_close_con(db):
    db.client.close()

def mongo_open_con():
    client = MongoClient("mongodb://localhost:27017/")
    db = client["szavazo_rendszer"]  # Az adatbázis nevét itt kell megadni
    return db

def mongo_record_vote(voter_name, vote):
    mongo_db =  mongo_open_con()

    collection = mongo_db["szavazatok"]

    document = {
        "szavazoNeve": voter_name,
        "szavazat": vote
    }

    collection.insert_one(document)

    print("Szavazat sikeresen rögzítve.")

def mongo_get_vote_by_voter(voter_name):
    mongo_db =  mongo_open_con()

    collection = mongo_db["szavazatok"]

    query = {"szavazoNeve": voter_name}
    projection = {"_id": 0, "szavazoNeve": 1, "szavazat": 1}

    result = collection.find_one(query, projection)

    if result:
        return f"Szavazo: {result['szavazoNeve']}, Szavazat: {result['szavazat']}"
    else:
        return "No vote found for the specified voter."


# Új kliens hozzáadása
def mongo_post_new_client(username, email, password):
    db = mongo_open_con()
    collection = db["kliens"]   

    try:
        new_client = {
            "username": username,
            "email": email,
            "password": password,
            "valasz_id": None
        }
        result = collection.insert_one(new_client)
        print("New client created successfully in mongoDB")
    except Exception as e:
        print("Error:", str(e))

    mongo_close_con(db)

# Kliens lekérése azonosító alapján
def mongo_get_client_by_id(id):
    db = mongo_open_con()
    collection = db["kliens"]

    try:
        result = collection.find_one({"_id": id})

        if result:
            ret = f"id: {result['_id']} - username: {result['username']} - email: {result['email']} - password: {result['password']}"
        else:
            ret = "Client not found!"
    except Exception as e:
        print("Error:", str(e))

    mongo_close_con(db)
    return ret

# Kliens lekérése e-mail alapján
def mongo_get_client_by_email(email):
    db = mongo_open_con()
    collection = db["kliens"]

    try:
        result = collection.find_one({"email": email})

        if result:
            ret = f"id: {result['_id']} - username: {result['username']} - email: {result['email']} - password: {result['password']}"
        else:
            ret = "Client not found!"
    except Exception as e:
        print("Error:", str(e))

    mongo_close_con(db)
    return ret








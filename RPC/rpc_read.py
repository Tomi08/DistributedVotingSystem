from datetime import datetime
from flask import Flask, request
from jsonrpcserver import method
import socket
import time
import sys
sys.path.append('./Database/')
import sql_kliens

app = Flask(__name__)

#---------------------------------DISPLAY-------------------

def create_socket_object():
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    return server_socket


def get_local_machine():
    my_host = socket.gethostname()
    my_port = 5001
    return my_host, my_port


def connect(client_socket):  # connect the client to the server
    client_socket.connect((host, port))
    print("Connected!")
    time.sleep(0.2)


def send_message(client_socket, my_message):
    client_socket.send(my_message.encode())
    print("Message Sent!")
    time.sleep(0.2)


def close_socket(client_socket):
    client_socket.close()
    print("Socket Closed!")
    time.sleep(0.2)

def get_current_time():
    current_time = datetime.now().time()
    formatted_time = current_time.strftime("%H:%M:%S")
    return formatted_time

@app.route('/kijelzo/update', methods=['GET'])
def update():
    nev = request.args.get('nev')
    szavazat = request.args.get('szavazat')
    message = nev + '@#$%' + szavazat + '@#$%' + get_current_time()
    my_socket = create_socket_object()
    connect(my_socket)
    send_message(my_socket, message)
    close_socket(my_socket)
    return (message + ' sent to display')


#----------------------------------------WEB-------------------

@app.route('/db/getclientbyemail',  methods = ['POST'])
def getclientbyemail():
    email = request.args.get('email')
    return sql_kliens.sql_get_client_by_email(email)

@app.route('/db/getclientbyid', methods = ['POST'])
def getclientbyid():
    id = request.args.get('id')
    return sql_kliens.sql_get_client_by_id(id)

@app.route('/db/getvote', methods=['POST'])
def getvote():
    name = request.args.get('name')
    qid = request.args.get('questionid')
    return sql_kliens.sql_get_vote_by_voter(name, qid)

if __name__ == '__main__':
    host, port = get_local_machine()
    app.run()
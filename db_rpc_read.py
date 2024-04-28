from flask import Flask, request
from jsonrpcserver import method
import socket
import time
import sys
sys.path.append('./Database/')
import subprocess

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

@app.route('/kijelzo/update', methods=['GET'])
def update():
    nev = request.args.get('nev')
    szavazat = request.args.get('szavazat')
    message = nev + '@#$%' + szavazat + '@#$%' + 'time'
    my_socket = create_socket_object()
    connect(my_socket)
    send_message(my_socket, message)
    close_socket(my_socket)
    return (message + ' sent to display')


#----------------------------------------WEB-------------------

@app.route('/db/getclientbyemail',  methods = ['GET'])
def getclientbyemail():
    function = "getclientbyemail";
    email = request.args.get('email')
    key = request.args.get('key')
    
    php_input =  function.encode('utf-8') + b'\n' + email.encode('utf-8') + b'\n' + key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output

@app.route('/db/get_vote_by_voter',  methods = ['GET'])
def get_vote_by_voter():
    function = "get_vote_by_voter";
    voter_name = request.args.get('voter_name')
    key = request.args.get('key')
    
    php_input = function.encode('utf-8') + b'\n' +voter_name.encode('utf-8') + b'\n' + key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output

@app.route('/db/get_question_answer_percentages',  methods = ['GET'])
def get_question_answer_percentages():
    function = "get_question_answer_percentages";
    key = request.args.get('key')
    
    php_input = function.encode('utf-8') + b'\n' +key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output

@app.route('/db/postNewClient',  methods = ['GET'])
def postNewClient():
    function = "postNewClient";
    username = request.args.get('username')
    email = request.args.get('email')
    password = request.args.get('password')
    key = request.args.get('key')
    
    php_input = function.encode('utf-8') + b'\n' +username.encode('utf-8') + b'\n' +email.encode('utf-8') + b'\n' +password.encode('utf-8') + b'\n' +key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output

@app.route('/db/updatePassword',  methods = ['GET'])
def updatePassword():
    function = "updatePassword";
    email = request.args.get('email')
    password = request.args.get('password')
    key = request.args.get('key')
    
    php_input = function.encode('utf-8') + b'\n' +email.encode('utf-8') + b'\n' +password.encode('utf-8') + b'\n' +key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output

@app.route('/db/record_vote',  methods = ['GET'])
def record_vote():
    function = "record_vote";
    kerdes_id = request.args.get('kerdes_id')
    voter_name = request.args.get('voter_name')
    vote = request.args.get('vote')
    kerdes = request.args.get('kerdes')
    key = request.args.get('key')

    php_input = function.encode('utf-8') + b'\n' +kerdes_id.encode('utf-8') + b'\n' +voter_name.encode('utf-8') + b'\n' + vote.encode('utf-8') + b'\n' + kerdes.encode('utf-8') + b'\n' +key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output


@app.route('/db/postNewQuestion',  methods = ['GET'])
def postNewQuestion():
    function = "postNewQuestion";
    question = request.args.get('question')
    key = request.args.get('key')
    
    php_input = function.encode('utf-8')+ b'\n' +question.encode('utf-8') + b'\n' +key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output
@app.route('/db/getQuestion',  methods = ['GET'])
def getQuestion():
    function = "getQuestion";
    key = request.args.get('key')
    
    php_input = function.encode('utf-8') + b'\n' +key.encode('utf-8')
    php_process = subprocess.Popen(['php','rpcHandler.php'],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE)
    php_output,php_error = php_process.communicate(input=php_input)
    return php_output

if __name__ == '__main__':
    host, port = get_local_machine()
    host = "192.168.0.179"
    port = 5001

    app.run(host=host,port=port)
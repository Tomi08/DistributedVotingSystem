from flask import Flask, request
from jsonrpcserver import method
import socket
import sys
sys.path.append('./Database/')
import sql_kliens

app = Flask(__name__)

serverAddressPort   = ("127.0.0.1", 5001)
# Create a UDP socket at client side
UDPClientSocket = socket.socket(family=socket.AF_INET, type=socket.SOCK_DGRAM)



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

@app.route('/kijelzo/update', methods=['GET'])
def update():
    nev = request.args.get('nev')
    szavazat = request.args.get('szavazat')
    # Send to server using created UDP socket
    bytesToSend = str.encode(nev + '@' + szavazat)
    UDPClientSocket.sendto(bytesToSend, serverAddressPort)
    return (bytesToSend.decode('utf-8') + ' sent to display')


if __name__ == '__main__':
    app.run()
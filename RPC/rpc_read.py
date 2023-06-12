from flask import Flask, request
from jsonrpcserver import method, methods
import sys
sys.path.append('./Database/')
import sql_kliens

app = Flask(__name__)

@method
def getvote(name):
    return sql_kliens.sql_get_vote_by_voter(name)

@method
def getclientbyemail(email):
    return sql_kliens.sql_get_client_by_email(email)

@method
def getclientbyid(id):
    return sql_kliens.sql_get_client_by_id(id)


@app.route('/db', methods=['GET'])
def rpc_endpoint():
    response = methods.dispatch(request.get_data(as_text=True))
    return response

if __name__ == '__main__':
    app.run()
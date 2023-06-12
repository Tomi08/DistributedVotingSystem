from flask import Flask, request
from jsonrpcserver import method, methods
import sys
sys.path.append('./Database/')
import sql_kliens

app = Flask(__name__)

@method


@app.route('/db/getclientbyemail',  methods = ['GET'])
def getclientbyemail(email):
    email = request.args.get('email')
    return sql_kliens.sql_get_client_by_email(email)

@app.route('/db/getclientbyid', methods = ['GET'])
def getclientbyid(id):
    id = request.args.get('id')
    return sql_kliens.sql_get_client_by_id(id)

@app.route('/db/getvote', methods=['GET'])
def getvote():
    name = request.args.get('name')
    print(name)
    return sql_kliens.sql_get_vote_by_voter(name)

# @app.route('/db/', methods=['GET'])
# def rpc_endpoint():
#     response = method.dispatch(request.get_data(as_text=True))
#     return response

if __name__ == '__main__':
    app.run()
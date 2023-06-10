# import socket programming library
import socket
import time

# import thread module
from _thread import *
from flask import Flask, request
import threading

from http.server import HTTPServer, BaseHTTPRequestHandler

import subprocess
from urllib.parse import parse_qs

import os

# Get the absolute path of the current directory
current_directory = os.path.dirname(os.path.abspath(__file__))


class MyRequestHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = '/registration_form.html' 
        
        try:
            # Open the file in binary mode
            with open(self.path[1:], 'rb') as file:
                content = file.read()
            if self.path.endswith('.html'):
                self.send_response(200)
                self.send_header('Content-type', 'text/html')
                self.end_headers()

                content = content.replace(b'{{CSS}}', b'<link rel="stylesheet" type="text/css" href="registration_form.css">')
                content = content.replace(b'{{JS}}', b'<script src="registration_form.js"></script>')

                self.wfile.write(content)
            elif self.path.endswith('.css'):
                self.send_response(200)
                self.send_header('Content-type', 'text/css')
                self.end_headers()
                self.wfile.write(content)
            elif self.path.endswith('.js'):
                self.send_response(200)
                self.send_header('Content-type', 'application/javascript')
                self.end_headers()
                self.wfile.write(content)
            elif self.path.endswith(('.jpg', '.jpeg', '.png', '.gif')):
                self.send_response(200)
                self.send_header('Content-type', 'image')
                self.end_headers()
                self.wfile.write(content)
        except IOError:
            self.send_error(404, 'File Not Found: {}'.format(self.path))

    def do_POST(self):
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length)

        # Parse the POST data
        data = parse_qs(post_data.decode('utf-8'))
        print(post_data)

        # Prepare the PHP script command
        php_script = 'process.php'
        print(data)
        # Execute the PHP script and capture the output
        php_process = subprocess.Popen(['php', php_script], stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
        php_output, php_error = php_process.communicate(input=post_data)

        # Check for any errors
        if php_error:
            self.send_response(500)
            self.send_header('Content-type', 'text/plain')
            self.end_headers()
            self.wfile.write(php_error)
        else:
            self.send_response(200)
            self.send_header('Content-type', 'html')
            self.end_headers()
            self.wfile.write(php_output)



server_address = ('', 8080)
httpd = HTTPServer(server_address, MyRequestHandler)
print("server is listening on port:", server_address[1])
httpd.serve_forever()




# print_lock = threading.Lock()

# # thread function
# def threaded(c):
#     n = 1
#     while True:

#         # data received from client
#         data = c.recv(1024)
#         data = 
#         c.send("./hello.html")
#         # if not data:
#         #     print('Bye')
#         #     # lock released on exit
#         #     print_lock.release()
#         #     break
#         # x = data.decode("ascii").split("/")
#         # k = x[3]
#         # time.sleep(int(k))
#         # if x[0] == "add":
#         #     data = str(add(int(x[1]), int(x[2])))
#         #     c.send(data.encode('ascii'))
#         #     break

#         # n += 1
#     # connection closed
#     #c.close()


# def add(a, b):
#     suma = int(a) + int(b)
#     return suma


# def Main():
#     host = ""

#     port = 80
#     s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#     s.bind((host, port))
#     print("socket binded to port", port)

#     # put the socket into listening mode
#     s.listen(5)
#     print("socket is listening")

#     # a forever loop until client wants to exit
#     while True:
#         # establish connection with client
#         c, addr = s.accept()

#         # lock acquired by client
#         print_lock.acquire()
#         print('Connected to :', addr[0], ':', addr[1])

#         # Start a new thread and return its identifier
        
#         start_new_thread(threaded, (c,))
        
#         print_lock.release()


#     s.close()


# if __name__ == '__main__':
#     Main()

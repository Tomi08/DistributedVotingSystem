import socket
import time
from datetime import datetime


def get_current_time():
    current_time = datetime.now().time()
    formatted_time = current_time.strftime("%H:%M:%S")
    return formatted_time


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


def create_message():
    question = "Question"
    name = "Name"
    vote = "Vote"
    sys_time = get_current_time()
    my_message = question + "@#$%" + name + "@#$%" + vote + "@#$%" + sys_time
    return my_message


if __name__ == "__main__":
    while True:
        my_socket = create_socket_object()
        host, port = get_local_machine()
        connect(my_socket)
        message = create_message()
        send_message(my_socket, message)
        close_socket(my_socket)
        time.sleep(2)
        print()

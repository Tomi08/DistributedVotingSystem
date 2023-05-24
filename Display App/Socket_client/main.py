import socket
import time


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


def send_message(client_socket, message):
    client_socket.send(message.encode())
    print("Message Sent!")
    time.sleep(0.2)


def close_socket(client_socket):
    client_socket.close()
    print("Socket Closed!")
    time.sleep(0.2)


if __name__ == "__main__":
    while True:
        my_socket = create_socket_object()
        host, port = get_local_machine()
        connect(my_socket)
        send_message(my_socket, "Nev@#$%Szavazat")
        close_socket(my_socket)
        time.sleep(1)
        print()

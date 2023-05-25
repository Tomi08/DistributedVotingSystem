import threading
import time
import socket
import msvcrt
import queue
import portalocker

mutex = threading.Lock()
queue = queue.Queue()


def create_socket_object():
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    return server_socket


def get_local_machine():
    host = socket.gethostname()
    port = 5001
    return host, port


def bind_socket(server_socket, my_host, my_port):
    server_socket.bind((my_host, my_port))


def write_vote_to_file(name, vote):
    with open("../votes.txt", "a+") as file:
        # portalocker.lock(file, portalocker.LOCK_EX)
        msvcrt.locking(file.fileno(), msvcrt.LK_LOCK, 1)

        file.write(name + ", " + vote + "\n")

        # portalocker.unlock(file)
        msvcrt.locking(file.fileno(), msvcrt.LK_UNLCK, 1)


def client_handler(client_socket):
    message = client_socket.recv(1024).decode()
    name, vote = map(str, message.split('@#$%'))
    time.sleep(0.5)
    write_vote_to_file(name, vote)


def listening(server_socket):
    server_socket.listen(10)
    print("Server listening on port 5001...")

    while True:
        # wait for a client to connect
        client_socket, addr = server_socket.accept()
        print(f"Accepted connection from {addr}")
        client_thread = threading.Thread(target=client_handler, args=(client_socket,))
        client_thread.start()
        client_thread.join()
        time.sleep(0.01)


def start_server():
    m_socket = create_socket_object()
    m_host, m_port = get_local_machine()
    bind_socket(m_socket, m_host, m_port)
    return m_socket


def server():
    my_socket = start_server()
    listening(my_socket)


if __name__ == '__main__':
    server_thread = threading.Thread(target=server, args=())
    server_thread.start()
    server_thread.join()

import subprocess

from flask import Flask, request, render_template, redirect

app = Flask(__name__)


@app.route('/', methods=['GET', 'POST'])
def index():
    print("In index")
    error = None
    if request.method == 'POST':
        print("POST");
        fromwhere = request.headers.get('Referer')
        adress = fromwhere.split('/')
        last_index = len(adress) - 1

        if 'Login' in request.form:
            print("LOGIN");
            email = request.form['email']

            password = request.form['password']
            email_found = False
            password_found = False

            with open("login_data.txt", "r") as file:
                print(email,password);
                for line in file:
                    if line.strip():
                        data = line.split(': ')
                        if data[0] == "email" and data[1] == email:
                            email_found = True
                        if line.strip() == ";;" and email_found and not password_found:
                            password_found = True
                        if data[0] == "password" and data[1] == password:
                            password_found = True

            if email_found and password_found:
                with open("error.txt", "w") as file:
                    file.write("")
                # Perform the necessary actions for successful login

                return redirect("form.php")
            elif not email_found:
                error = "Hibás felhasználónév"
            elif not password_found:
                error = "Hibás jelszó"
            else:
                error = "Hibás felhasználónév vagy jelszó!"

            with open('error.txt', 'a') as file:
                file.write(error)
            return redirect("registration_form.html")

        elif 'Register' in request.form:
            email = request.form['email']
            ip_address = request.remote_addr
            password = request.form['password']
            email_found = False

            with open("login_data.txt", "r") as file:
                for line in file:
                    if line.strip():
                        data = line.split(': ')
                        if data[0] == 'email' and data[1] == email:
                            email_found = True
                            break

            if not email_found:
                with open("login_data.txt", "a") as file:
                    file.write("\n;;\nIP: " + ip_address + "\n")
                    for key, value in request.form.items():
                        file.write(key + ": " + value + "\n")
                    file.write(";;\n")
                return redirect("registration_form.html")
            else:
                return redirect("registration_form.html")

        elif 'Send' in request.form:
            to = request.form['email']
            receiver = request.form['email']
            subject = "Jelszó helyreállítása"
            body = "Az adott email címre jelszó helyreállítási kérelem történt, amennyiben ön kérvényezte az alábbi linken lévő utasításokkal tudja megváltoztatni a jelszavát http://localhost:80/reset_password_form.html"
            sender = "osztottprojekt@gmail.com"
            # Perform the necessary actions for sending the email
            return redirect("registration_form.html")

        elif adress[last_index] == "reset_password_form.html":
            return redirect("registration_form.html")

        elif adress[last_index] == "form.php":
            ip_address = request.remote_addr
            with open("data.txt", "a") as file:
                file.write("\nIP: " + ip_address + "\n")
                for key, value in request.form.items():
                    file.write(key + ": " + value + "\n")
            return redirect("form.php")

    return render_template('registration_form.html', error=error)


def execute_php_code(php_code, data):
    # print(data)
    # Run the PHP code as a subprocess and capture the output
    php_process = subprocess.Popen(['php', php_code], stdout=subprocess.PIPE)
    php_output, _ = php_process.communicate()
    # Return the output and any errors
    return php_output


@app.route('/form.php', methods=['POST'])
def form():
    error = None
    if request.method == 'POST':
        # Get the form data
        # print(request.form)
        print("Hello")
        data = {
            # 'email': request.form['email'],
            # 'password': request.form['password'],
            # 'Login': request.form.get('Login'),
            # 'Register': request.form.get('Register'),
            # 'Send': request.form.get('Send')
        }
        output = execute_php_code('form.php', data)

    return output


if __name__ == '__main__':
    app.run(debug=True, port=8080)

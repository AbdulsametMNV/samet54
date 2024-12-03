from flask import Flask, request, redirect, url_for, render_template, flash, session, jsonify
import sqlite3
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)
app.secret_key = 'some_secret_key'

# Veritabanı bağlantısı fonksiyonu
def get_db_connection():
    conn = sqlite3.connect('veritabani.db')
    conn.row_factory = sqlite3.Row
    return conn

# Veritabanı tablosunu oluşturma fonksiyonu
def create_tables():
    conn = get_db_connection()
    cursor = conn.cursor()

    cursor.execute(''' 
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )
    ''')

    conn.commit()
    conn.close()

# Kullanıcı kaydolma route'u
@app.route('/kaydol', methods=['GET', 'POST'])
def kaydol():
    if request.method == 'POST':
        data = request.get_json()
        username = data.get('username')
        password = data.get('password')

        conn = get_db_connection()
        cursor = conn.cursor()

        try:
            hashed_password = generate_password_hash(password)
            cursor.execute('INSERT INTO users (username, password) VALUES (?, ?)', (username, hashed_password))
            conn.commit()
            return jsonify({'message': 'Kayıt başarılı!'}), 201
        except sqlite3.IntegrityError:
            return jsonify({'error': 'Bu kullanıcı adı zaten mevcut!'}), 409
        finally:
            conn.close()

    return render_template('register.html')

# Kullanıcı girişi route'u (admin kontrolü dahil)
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        data = request.get_json()  # AJAX istekleri için
        username = data.get('username')
        password = data.get('password')

        # Admin kontrolü
        if username == 'admin' and password == 'admin1234':
            session['user_id'] = 0  # Admin için özel bir ID tanımlayabiliriz
            session['username'] = 'admin'
            return jsonify({"message": "Admin olarak giriş başarılı!"}), 200

        # Normal kullanıcı girişi
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute('SELECT * FROM users WHERE username = ?', (username,))
        user = cursor.fetchone()
        conn.close()

        if user and check_password_hash(user['password'], password):
            session['user_id'] = user['id']  # Oturum aç
            session['username'] = user['username']  # Kullanıcı adını oturumda sakla
            return jsonify({"message": "Giriş başarılı!"}), 200
        else:
            return jsonify({"error": "Kullanıcı adınız veya şifreniz yanlış!"}), 401

    return render_template('login.html')

# Ana sayfa
@app.route('/')
def index():
    return render_template('index.html')

# Admin sayfası
@app.route('/admin')
def admin():
    if 'user_id' in session and session['user_id'] == 0:  # Admin ID kontrolü
        return render_template('admin.html')
    else:
        return redirect(url_for('login'))

if __name__ == '__main__':
    create_tables()
    app.run(debug=True)

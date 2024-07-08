# import os; os.system('pip install Faker'); os.system('pip install pymysql')
from faker import Faker; dummy = Faker('id'); import pymysql; import random
def maleName(): return dummy.first_name_male() + " " + dummy.last_name_male()
def femaleName(): return dummy.first_name_female() + " " + dummy.last_name_female()
def generate_total(): return random.randint(2, 4)

# note  : 32 male - 47 female || blood_type randomize but must be distributed
# date  : from [20-04-2024x20-06-2024] to [28-06-2024x28-08-2024]
# stock : between 2 and 4 || order by start, name, code, stock, exp, gender
# tanggal_donor, nama_pendonor, kode_darah, jumlah_kantong, tanggal_kedaluwarsa, JK

# connection setup
connection = pymysql.connect(
    host="localhost", 
    user='root', 
    password='', 
    database='hospital_database'
); cursor = connection.cursor()

def update_pendonor(gender):
    query = 'UPDATE PENDONOR SET JUMLAH_PENDONOR = JUMLAH_PENDONOR + 1 '
    query += f'WHERE JENIS_KELAMIN = "{gender}"'; cursor.execute(query)
    connection.commit()

def update_stok(kode_darah, total):
    query = f'UPDATE STOK_DARAH SET STOK = STOK + {total} ';
    query += f'WHERE KODE_DARAH = "{kode_darah}"'
    cursor.execute(query); connection.commit()

def add_darah_masuk(kode_darah, total):
    query = f'UPDATE TRANSAKSI_DARAH SET DARAH_MASUK = DARAH_MASUK + {total} '
    query += f'WHERE kode_darah = "{kode_darah}"'; cursor.execute(query)
    connection.commit()

def inject_donor_darah(dataset):
    query = f"INSERT INTO DONOR_DARAH (tanggal_donor, nama_pendonor, kode_darah, jumlah_kantong, "
    query += f"tanggal_kedaluwarsa, jenis_kelamin) VALUES ('{dataset[0]}', "
    query += f"'{dataset[1]}', '{dataset[2]}', '{dataset[3]}', '{dataset[4]}', '{dataset[5]}')"
    cursor.execute(query); connection.commit(); update_pendonor(dataset[5])
    update_stok(dataset[2], dataset[3]); add_darah_masuk(dataset[2], dataset[3]); 

def generate_start_date():
    day = str(random.randint(1, 20)).zfill(2)
    month = str(random.randint(4, 6)).zfill(2)
    year = 2024; return f"{year}-{month}-{day}"

def generate_expired_date():
    day = str(random.randint(21, 28)).zfill(2)
    month = str(random.randint(6, 8)).zfill(2)
    year = 2024; return f"{year}-{month}-{day}"

def generate_code():
    list_code = [
        "A+", "A-",  "B+", "B-", 
        "AB+", "AB-", "O+", "O-"
    ]; return random.choice(list_code)

def generate_main_female():    
    datasets = [
        generate_start_date(),
        femaleName(),
        generate_code(),
        generate_total(),
        generate_expired_date(),
        "Perempuan"
    ]; inject_donor_darah(datasets)

def generate_main_male():    
    datasets = [
        generate_start_date(),
        maleName(),
        generate_code(),
        generate_total(),
        generate_expired_date(),
        "Laki-Laki"
    ]; inject_donor_darah(datasets)
    
for data in range(47): generate_main_female()
for data in range(32): generate_main_male()
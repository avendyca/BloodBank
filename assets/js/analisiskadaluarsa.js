function generateDemoTable(){
    document.addEventListener('DOMContentLoaded', function () {
        const expiringData = [
            { bloodType: 'A+', expirationDate: '2024-06-25', units: 2 },
            { bloodType: 'B+', expirationDate: '2024-06-18', units: 2 },
            { bloodType: 'O+', expirationDate: '2024-07-02', units: 1 },
            { bloodType: 'AB-', expirationDate: '2024-06-20', units: 3 },
            { bloodType: 'A-', expirationDate: '2024-07-04', units: 1 },
            { bloodType: 'B-', expirationDate: '2024-07-05', units: 1 }
        ];
    
        const today = new Date();
        const sevenDaysFromNow = new Date();
        sevenDaysFromNow.setDate(today.getDate() + 7);
    
        const tableBody = document.querySelector('#expiringTable tbody');
        let expiringSoonCount = 0;
    
        expiringData.forEach(item => {
            const expirationDate = new Date(item.expirationDate);
            const isExpiringSoon = expirationDate <= sevenDaysFromNow;
            if (isExpiringSoon) {
                expiringSoonCount++;
            }
    
            const row = document.createElement('tr');
            row.classList.toggle('expiring-soon', isExpiringSoon);
            row.innerHTML = `
                <td>${item.bloodType}</td>
                <td>${item.expirationDate}</td>
                <td>${item.units}</td>
            `;
            tableBody.appendChild(row);
        });
    
        document.getElementById('total-stock').textContent = expiringData.length;
        document.getElementById('expiring-soon').textContent = expiringSoonCount;
    });    
}

// panggil untuk menggunakan tabel demo:
// generateDemoTable();
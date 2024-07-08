document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('donorTable');
    let editingRow = null;

    table.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-btn')) {
            const row = event.target.closest('tr');
            editingRow = row;
            const cells = row.querySelectorAll('td');
            openEditModal(cells);
        }
    });

    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close-btn');
    const editForm = document.getElementById('editForm');

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    editForm.addEventListener('submit', (event) => {
        // event.preventDefault();
        const cells = editingRow.querySelectorAll('td');
        cells[0].innerText = document.getElementById('editStart').value;
        cells[1].innerText = document.getElementById('editNama').value;
        cells[2].innerText = document.getElementById('editKode').value;
        cells[3].innerText = document.getElementById('editJumlah').value;
        cells[4].innerText = document.getElementById('editKedaluwarsa').value;
        cells[5].innerText = document.getElementById('editGender').value;

        modal.style.display = 'none';
    });

    function openEditModal(cells) {
        document.getElementById('editStart').value = cells[0].innerText;
        document.getElementById('editNama').value = cells[1].innerText;
        document.getElementById('editKode').value = cells[2].innerText;
        document.getElementById('editJumlah').value = cells[3].innerText;
        document.getElementById('jumlahSebelumnya').value = cells[3].innerText;
        document.getElementById('editKedaluwarsa').value = cells[4].innerText;
        document.getElementById('editGender').value = cells[5].innerText;
        document.getElementById('id-donor').value = cells[6].innerText;

        modal.style.display = 'block';
    }
});

function makePercentage(unit, total){
    return unit/total * 100;
}

document.addEventListener('DOMContentLoaded', function () {
    const genderData = {
        male: makePercentage(maleCount, (maleCount + femaleCount)),
        female: makePercentage(femaleCount, (maleCount + femaleCount))
    };

    const ctx = document.getElementById('genderChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                label: 'Gender Distribution',
                data: [genderData.male, genderData.female],
                backgroundColor: ['#66b3ff', '#ff9999'],
                hoverBackgroundColor: ['#3399ff', '#ff6666']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                        }
                    }
                }
            }
        }
    });
});


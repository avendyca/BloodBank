// const body = document.querySelector("body"),
//         sidebar = body.querySelector("nav"),
//         toggle = body.querySelector(".toggle"),
//         searchBtn = body.querySelector(".search-box"),
//         modeSwitch = body.querySelector(".toggle-switch"),
//         modeText = body.querySelector(".mode-text");

//       toggle.addEventListener("click", () => {
//         sidebar.classList.toggle("close");
//       });

//       searchBtn.addEventListener("click", () => {
//         sidebar.classList.remove("close");
//       });

//       modeSwitch.addEventListener("click", () => {
//         body.classList.toggle("dark");

//         if (body.classList.contains("dark")) {
//           modeText.innerText = "Light mode";
//         } else {
//           modeText.innerText = "Dark mode";
//         }
//       });

const demoDarahMasuk = [50, 90, 60, 70, 5, 3, 30, 40];
const demoDarahKeluar = [9, 50, 34, 45, 1, 1, 9, 25];

const labels = []; const inner = []; const outer = [];
for (i=1; i<9; i++){
    labels.push(document.getElementById(`kode-${i}`).innerHTML);
    inner.push(document.getElementById(`masuk-${i}`).innerHTML);
    outer.push(document.getElementById(`keluar-${i}`).innerHTML);
}

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('bloodChart').getContext('2d');
    const bloodChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Darah Masuk',
                data: inner,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Darah Keluar',
                data: outer,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  });
  
  
        
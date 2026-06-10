const COLORS = ['#B8860B','#8b4513','#5c4033','#e2d1b3','#d4a017','#6b3a2a'];

Chart.defaults.color = '#e2d1b3';
Chart.defaults.borderColor = 'rgba(184,134,11,0.15)';

new Chart(document.getElementById('chartMonthly'), {
    type: 'line',
    data: {
        labels: monthLabels,
        datasets: [{
            label: 'Hewan Terdaftar',
            data: monthData,
            borderColor: '#B8860B',
            backgroundColor: 'rgba(184,134,11,0.1)',
            borderWidth: 2,
            pointBackgroundColor: '#B8860B',
            pointRadius: 5,
            tension: 0.4,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: 'rgba(184,134,11,0.1)' } },
            x: { grid: { color: 'rgba(184,134,11,0.1)' } }
        }
    }
});

new Chart(document.getElementById('chartAnimals'), {
    type: 'doughnut',
    data: {
        labels: animalLabels,
        datasets: [{
            data: animalData,
            backgroundColor: COLORS,
            borderColor: '#1a120b',
            borderWidth: 3,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'right', labels: { padding: 16, font: { size: 11 }, color: '#e2d1b3' } }
        },
        cutout: '65%',
    }
});

new Chart(document.getElementById('chartDiagnoses'), {
    type: 'bar',
    data: {
        labels: diagLabels.length ? diagLabels : ['Belum ada data'],
        datasets: [{
            label: 'Jumlah Kasus',
            data: diagData.length ? diagData : [0],
            backgroundColor: COLORS,
            borderRadius: 0,
            borderSkipped: false,
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: 'rgba(184,134,11,0.1)' } },
            y: { grid: { color: 'rgba(184,134,11,0.1)' } }
        }
    }
});

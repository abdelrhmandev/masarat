const initProgress = document.getElementById('initialProgress')
const totalCases = document.getElementById('totalCases')
const notCompletedCaseCount_ratio = document.getElementById('notCompletedCaseCount_ratio')
const submittedCaseCount_ratio = document.getElementById('submittedCaseCount_ratio')
const doughnut3 = document.getElementById('doughnut3')

const dataDoughnut = {
    labels: ['المنفذة', ' تحت التنفيذ', ' الغير منفذة'],
    datasets: [
        {
            data: [
                (doughnut1.value / totalCases.value) * 100,
                (doughnut2.value / totalCases.value) * 100,
                (doughnut3.value / totalCases.value) * 100
            ],
            backgroundColor: [
                'rgb(133, 105, 241)',
                'rgb(101, 143, 241)',
                'rgb(164, 101, 241)'
            ],
            datalabels: {
                anchor: 'start',
                borderWidth: 0
            },
            hoverOffset: 4
        }
    ]
}

const configDoughnut = {
    type: 'doughnut',
    data: dataDoughnut,
    options: {
        responsive: true,
        aspectRatio: 1,
        maintainAspectRatio: false,
        cutoutPercentage: 60,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    font: {
                        family: 'cairo',
                        size: 12,
                        color: 'black'
                    }
                }
            }
        },
        animation: {
            duration: 2000
        }
    }
}

let chartBar = new Chart(
    document.getElementById('chartDoughnut1'),
    configDoughnut
)

let chartBar2 = new Chart(
    document.getElementById('chartDoughnut2'),
    configDoughnut
)

let chartBar3 = new Chart(
    document.getElementById('chartDoughnut3'),
    configDoughnut
)

let chartBar4 = new Chart(
    document.getElementById('chartDoughnut4'),
    configDoughnut
)

const devIntsCase = document.getElementById('devIntsCase')
const transferedCase = document.getElementById('transferedCase')
const dataDoughnutdevIntsCasetransfered = {
    labels: ['التدخلات المفروزه', 'التدخلات المحوله'],
    datasets: [
        {
            data: [devIntsCase.value, transferedCase.value],
            backgroundColor: ['rgb(133, 105, 241)', 'rgb(101, 143, 241)'],
            datalabels: {
                anchor: 'start',
                borderWidth: 0
            },
            hoverOffset: 4
        }
    ]
}

const configDoughnutdevIntsCasetransfered = {
    type: 'doughnut',
    data: dataDoughnutdevIntsCasetransfered,
    options: {
        responsive: true,
        aspectRatio: 1,
        maintainAspectRatio: false,
        cutoutPercentage: 60,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    font: {
                        family: 'cairo',
                        size: 12,
                        color: 'black'
                    }
                }
            }
        },
        animation: {
            duration: 2000
        }
    }
}

let chartDoughnutdevIntstransfered = new Chart(
    document.getElementById('chartDoughnutdevIntstransfered'),
    configDoughnutdevIntsCasetransfered
)

const configDoughnutnotCompleted_with_completed_cases = {
    type: 'doughnut',
    data: dataDoughnutdnotCompleted_with_completed_cases,
    options: {
        responsive: true,
        aspectRatio: 1,
        maintainAspectRatio: false,
        cutoutPercentage: 60,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    font: {
                        family: 'cairo',
                        size: 12,
                        color: 'black'
                    }
                }
            }
        },
        animation: {
            duration: 2000
        }
    }
}

let dataDoughnutdnotCompleted_with_completed_cases = new Chart(
    document.getElementById('chartDoughnutdevIntstransfered'),
    dataDoughnutdnotCompleted_with_completed_cases
)
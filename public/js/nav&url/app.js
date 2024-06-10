window.onload = function () {
    const url = window.location.href.toString()
    switch (true) {
        case url.includes('/dashboard'):
            document
                .getElementById('dashboard')
                .classList.add('text-indigo-400')
            break
        case url.includes('/transferCase'):
            document
                .getElementById('transferCase')
                .classList.add('text-indigo-400')
            break
        case url.includes('/interventions'):
        case url.includes('/ints'):
            document
                .getElementById('interventions')
                .classList.add('text-indigo-400')
            break
        case url.includes('/providers'):
            document
                .getElementById('providers')
                .classList.add('text-indigo-400')
            break
        case url.includes('/supported'):
            document
                .getElementById('supported')
                .classList.add('text-indigo-400')
            break
        case url.includes('/rejectedSupport'):
            document
                .getElementById('rejectedSupport')
                .classList.add('text-indigo-400')
            break
        case url.includes('/approvedSupport'):
            document
                .getElementById('approvedSupport')
                .classList.add('text-indigo-400')
            break
        case url.includes('/returned'):
            document.getElementById('returned').classList.add('text-indigo-400')
            break
        case url.includes('/notCompleted'):
            document
                .getElementById('notCompleted')
                .classList.add('text-indigo-400')
            break
        case url.includes('/hangged'):
            document.getElementById('hangged').classList.add('text-indigo-400')
            break
        case url.includes('/executed'):
            document.getElementById('executed').classList.add('text-indigo-400')
            break
        case url.includes('/users'):
            document.getElementById('users').classList.add('text-indigo-400')
            break
        case url.includes('/trackIntsExecution'):
        case url.includes('/tracking'):
        case url.includes('/oneTrack'):
            document
                .getElementById('trackIntsExecution')
                .classList.add('text-indigo-400')
            break
    }

    const rowTen = document.getElementById('ten')
    const rowThirty = document.getElementById('thirty')
    const rowFifty = document.getElementById('fifty')

    if (url.includes('?count=10')) {
        rowTen.classList.add('text-blue-700', 'font-bold', 'border-blue-700')

        rowThirty.classList.remove(
            'text-blue-700',
            'font-bold',
            'border-blue-700'
        )
        rowFifty.classList.remove(
            'text-blue-700',
            'font-bold',
            'border-blue-700'
        )
    } else if (url.includes('?count=30')) {
        rowThirty.classList.add('text-blue-700', 'font-bold', 'border-blue-700')

        rowTen.classList.remove('text-blue-700', 'font-bold', 'border-blue-700')
        rowFifty.classList.remove(
            'text-blue-700',
            'font-bold',
            'border-blue-700'
        )
    } else if (url.includes('?count=50')) {
        rowFifty.classList.add('text-blue-700', 'font-bold', 'border-blue-700')

        rowTen.classList.remove('text-blue-700', 'font-bold', 'border-blue-700')
        rowThirty.classList.remove(
            'text-blue-700',
            'font-bold',
            'border-blue-700'
        )
    }

    const notification = document.getElementById('notification')
    if (notification) {
        setTimeout(popNotification, 3000)
        function popNotification() {
            document.getElementById('notification').classList.add('hidden')
        }
    }
}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part')
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="shortcut icon" href="/assets/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Dashboard</title>

    <link href="/assets/css/app.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet"
    />

    <title>Admin</title>
</head>

<body>
<div class="wrapper">
    @include('admin.partials.sidebar-part', ['chart' => 'true'])
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">
                <div class="container">
                    <button class="btn btn-secondary mt-2" type="button" id="viewChart">View Chart</button>
                    <div class="container d-flex mt-3">
                        <div class="container h-50 my-auto" id="panel-input-year"></div>
                        <div class="container" id="panel-chart"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>

@include('admin.partials.script-part')
<script>

    function clear()
    {
        const input = document.getElementById('panel-input-year');
        while(input.hasChildNodes()){
            input.firstChild.remove();
        }
    }

    document.getElementById('viewChart').onclick = () => {
        clear();
        const year = document.createElement('input');
        year.type = 'number';
        year.min = '1900';
        year.placeholder = 'Input tahun';
        year.id = 'year-value';
        const submit = document.createElement('button');
        submit.type = 'button';
        submit.classList.add('btn');
        submit.classList.add('btn-primary');
        submit.classList.add('btn-sm');
        submit.classList.add('ms-2');
        submit.textContent = 'submit';
        submit.id = 'year-submit';
        document.getElementById('panel-input-year').appendChild(year);
        document.getElementById('panel-input-year').appendChild(submit);

        document.getElementById('year-submit').onclick = () => {
            while (document.getElementById('panel-chart').hasChildNodes()){
                document.getElementById('panel-chart').firstChild.remove();
            }
            viewChart(document.getElementById('year-value').value);
        }
    }

    async function chartData(year)
    {
        const response = await fetch('/api/chart/'+year, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        return response.json();
    }

    function viewChart(year)
    {
        let month = [], value = [];
        chartData(year)
            .then((data) => {
                for (const dat of data) {
                    month.push(dat.month);
                    value.push(dat.count_book);
                    // console.info(dat.month);
                }
            })
            .then(function(){
                const canvas = document.createElement('canvas');
                canvas.id = 'myChart';
                canvas.classList.add('chartjs-bar');

                new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: month,
                        datasets: [{
                            label: 'Peminjaman tahun ' + year,
                            data: value,
                            borderWidth: 2
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

                document.getElementById('panel-chart').appendChild(canvas);
                document.getElementById('viewChart').disabled =  true;
            }).catch(error => console.error(error))
    }
</script>
</html>

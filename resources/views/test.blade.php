
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="p-5">
    <table class="table table-bordered">
        <tr>
            <th>Team Name</th>
            <th>Team Description</th>
            <th>Team creator</th>

        </tr>
    @foreach($data as $result)
    {
        <tr>
      <td> {{ $result->team_name}}</td>
      <td> {{ $result->team_description}}</td>
      <td> {{ $result->team_creator}}</td>
    </tr>
    }

    @endforeach
</table>

{{ $data->links() }}
    
</body>
</html>




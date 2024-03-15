<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>2Todo</title>
    @yield('styles')
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    @yield('content')

    <script>
         function edittoggle() {
        var editModal = document.getElementById("editModal");
        if (editModal.style.display === "none") {
            editModal.style.display = "block";
         } else {
            editModal.style.display = "none";
        }
    }
    function closeEditModal() {
        var modal = document.getElementById("editModal");
        editModal.style.display = "none";
        var passwordModal = document.getElementById("passwordModal");
        passwordModal.style.display = "none";
        var deleteModal = document.getElementById("deleteModal");
        deleteModal.style.display = "none";
    }

    function passwordToggle(){
        var passwordModal = document.getElementById("passwordModal");
        if (passwordModal.style.display === "none") {
            passwordModal.style.display = "block";
         } else {
            passwordModal.style.display = "none";
        }
    }
    function deleteToggle(){
        var deleteModal = document.getElementById("deleteModal");
        if (deleteModal.style.display === "none") {
            deleteModal.style.display = "block";
         } else {
            delzModal.style.display = "none";
        }
    }
    </script>
      @if(session('error'))
        <script>
            var editModal = document.getElementById("editModal");
            editModal.style.display = "block";
        </script>
        @elseif (session('delete_error'))
        <script>
            var deleteModal = document.getElementById("deleteModal");
            deleteModal.style.display = "block";
        </script>
        @elseif (session('pass_error'))
        <script>
             var passwordModal = document.getElementById("passwordModal");
             passwordModal.style.display = "block";
        </script>
      @endif
      @if (!session()->has('delete_error'))
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete?');
        }
    </script>
      @endif
</body>
</html>

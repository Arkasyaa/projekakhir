<h1>login</h1>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button>login</button>
</form>
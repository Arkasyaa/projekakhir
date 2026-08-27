<h1>login</h1>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <input t ype="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button>login</button>
</form>
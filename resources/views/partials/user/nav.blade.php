<nav class="navigation">
    <ul class="navigation navigation__bar">
        <li class="navigation__item">
            <a href="#">Profile</a>
        <li>
        <li class="navigation__item">
            <form action={{route('logout')}} method="POST">
                @csrf
                <input type="submit" value="Log Out" />
            </form>
        </li>
    </ul>
</nav>
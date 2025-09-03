<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300, 400, 500" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* General variables */
    :root {
        --bdrds: 3px;
        --white: #fff;
        --black: #000;
        --gray: #ccc;
        --salmon: #e8716d;
        --smoky-black: rgba(34, 34, 34, 0.85);
        --ff: 'Montserrat', sans-serif;
        --ff-body: 12px;
        --ff-light: 300;
        --ff-regular: 400;
        --ff-medium: 500;
    }

    /* General configs */
    * {
        box-sizing: border-box;
    }

    . body {
        font-family: var(--ff);
        font-size: var(--ff-body);
        line-height: 1em;
    }

    button,
    input {
        background-color: transparent;
        padding: 0;
        border: 0;
        outline: 0;
        cursor: pointer;
    }

    input[type="submit"] {
        cursor: pointer;
    }

    input::placeholder {
        font-size: 0.85rem;
        font-family: var(--ff);
        font-weight: var(--ff-light);
        letter-spacing: 0.1rem;
        color: var(--gray);
    }

    /* Animations */
    @keyframes bounceLeft {
        0% {
            transform: translate3d(100%, -50%, 0);
        }

        50% {
            transform: translate3d(-30px, -50%, 0);
        }

        100% {
            transform: translate3d(0, -50%, 0);
        }
    }

    @keyframes bounceRight {
        0% {
            transform: translate3d(0, -50%, 0);
        }

        50% {
            transform: translate3d(calc(100% + 30px), -50%, 0);
        }

        100% {
            transform: translate3d(100%, -50%, 0);
        }
    }

    @keyframes showSignUp {
        100% {
            opacity: 1;
            visibility: visible;
            transform: translate3d(0, 0, 0);
        }
    }

    /* Page background */
    .user {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        background: #ccc;
        background-size: cover;
    }

    .user_options-container {
        position: relative;
        width: 80%;
    }

    .user_options-text {
        display: flex;
        justify-content: space-between;
        width: 100%;
        background-color: var(--smoky-black);
        border-radius: var(--bdrds);
    }

    /* Registered and Unregistered user box and text */
    .user_options-registered,
    .user_options-unregistered {
        width: 50%;
        padding: 75px 45px;
        color: var(--white);
        font-weight: var(--ff-light);
    }

    .user_registered-title,
    .user_unregistered-title {
        margin-bottom: 15px;
        font-size: 1.66rem;
        line-height: 1em;
    }

    .user_unregistered-text,
    .user_registered-text {
        font-size: 0.83rem;
        line-height: 1.4em;
    }

    .user_registered-login,
    .user_unregistered-signup {
        display: inline-block;
        margin-top: 25px;
        text-decoration: none;
        border: 1px solid var(--gray);
        border-radius: var(--bdrds);
        padding: 10px 30px 10px 30px;
        color: var(--white);
        text-transform: uppercase;
        line-height: 1em;
        letter-spacing: 0.2rem;
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    .user_registered-login:hover,
    .user_unregistered-signup:hover {
        color: var(--smoky-black);
        background-color: var(--gray);
    }

    /* Login and signup forms */
    .user_options-forms {
        height: 680px;
        position: absolute;
        top: 50%;
        left: 30px;
        width: calc(50% - 30px);
        min-height: 420px;
        background-color: var(--white);
        border-radius: var(--bdrds);
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.25);
        overflow: visible;
        transform: translate3d(100%, -50%, 0);
        /* إضافة padding داخلي */

    }

    .user_forms-login {
        transition: opacity 0.4s ease-in-out, visibility 0.4s ease-in-out;
    }

    .forms_title {
        margin-bottom: 45px;
        font-size: 1.5rem;
        font-weight: var(--ff-medium);
        line-height: 1em;
        text-transform: uppercase;
        color: var(--salmon);
        letter-spacing: 0.1rem;
    }

    .forms_field:not(:last-of-type) {
        margin-bottom: 20px;
    }

    .forms_form {

        height: auto !important;
        padding: 20px;
    }

    .forms_field-input {
        width: 100%;
        border-bottom: 1px solid var(--gray);
        padding: 6px 20px 6px 6px;
        font-family: var(--ff) font-size: 1rem;
        font-weight: var(--ff-light);
        color: #8c8c8c;
        letter-spacing: 0.1rem;
        transition: border-color 0.2s ease-in-out;
    }

    .forms_field-input:focus {
        border-color: #8c8c8c;
    }

    .forms_buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 35px;
    }

    .forms_buttons-forgot {
        font-family: var(--ff);
        letter-spacing: 0.1rem;
        color: var(--gray);
        text-decoration: underline;
        transition: color 0.2s ease-in-out;
    }

    .forms_buttons-forgot:hover {
        color: #b3b3b3;
    }

    .forms_buttons-action {
        background-color: var(--salmon);
        border-radius: var(--bdrds);
        padding: 10px 35px;
        font-size: 1rem;
        font-family: var(--ff);
        font-weight: var(--ff-light);
        color: var(--white);
        text-transform: uppercase;
        letter-spacing: 0.1rem;
        transition: background-color 0.2s ease-in-out;
    }

    .forms_buttons-action:hover {
        background-color: #d75e5a;
    }

    .user_forms-signup,
    .user_forms-login {
        position: absolute;
        top: 70px;
        left: 40px;
        width: calc(100% - 80px);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.4s ease-in-out, visibility 0.4s ease-in-out, transform 0.5s ease-in-out;
    }

    .user_forms-signup {
        transform: translate3d(120px, 0, 0);
        height: auto !important;
        min-height: 480px;
        /* زود الرقم حسب طول الفورم */
        padding-bottom: 30px;
        /* مساحة إضافية أسفل */
    }

    .user_forms-signup .forms_buttons {
        justify-content: flex-end;
    }

    .user_forms-login {
        transform: translate3d(0, 0, 0);
        opacity: 1;
        visibility: visible;
    }

    /* Triggers */
    .user_options-forms.bounceLeft {
        animation: bounceLeft 1s forwards;
    }

    .user_options-forms.bounceLeft .user_forms-signup {
        animation: showSignUp 1s forwards;
    }

    .user_options-forms.bounceLeft .user_forms-login {
        opacity: 0;
        visibility: hidden;
        transform: translate3d(-120px, 0, 0);
    }

    .user_options-forms.bounceRight {
        animation: bounceRight 1s forwards;
    }

    /* Responsive 990px */
    @media screen and (max-width: 990px) {
        .user_options-forms {
            min-height: 350px;
        }

        .forms_buttons {
            flex-direction: column;
        }

        .user_forms-login .forms_buttons-action {
            margin-top: 30px;
        }

        .user_forms-signup,
        .user_forms-login {
            top: 40px;
        }

        .user_options-registered,
        .user_options-unregistered {
            padding: 50px 45px;
        }
    }
</style>

<body>


    <section class="user">
        <div class="user_options-container">
            <div class="user_options-text">
                <div class="user_options-unregistered">
                    <h2 class="user_unregistered-title">You have an acoount?</h2>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <a class="user_unregistered-signup" id="signup-button" href="{{ route('login') }}">Login<a>

                    </form>

                </div>



                {{-- <div class="user_options-registered">
                    <h2 class="user_registered-title">Have an account?</h2>
                    <button class="user_registered-login" id="login-button">Login</button>
                </div>
            </div> --}}

                <div class="user_options-forms" id="user_options-forms">
                    <div class="user_forms-login">
                        <h2 class="forms_title">Register</h2>
                        <form class="forms_form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <fieldset class="forms_fieldset">
                                <div class="forms_field">
                                    <label class="col-md-4 col-form-label text-md-end"
                                        for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="forms_field-input @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="forms_field">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <input id="email" type="email"
                                        class="forms_field-input @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="forms_field">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>


                                    <input id="password" type="password"
                                        class="forms_field-input @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>
                                <div class="forms_field">

                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="forms_field-input"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </fieldset>
                            <div class="forms_buttons">
                                <button type="submit" class="forms_buttons-action">
                                    {{ __('Register') }}
                                </button>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <script></script>
</body>

</html>

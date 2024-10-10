@extends('layouts.LOUser.app')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>

.contact{
    width: 100%;
    overflow: hidden;
    background-color: white;
    position: fixed ;
    padding-left: 350px;
}

.contact .container{
    height: 100vh;
    min-height: 300px;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr;
}
.left{
    width: 90%;
    max-width: 80rem;
    margin: 0 auto;
    /* background-color: white; */
    padding-bottom: 250px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    align-items: center;
    z-index: 3;
    justify-content: center;
    border-radius: 60px;
    text-align: center;
}
.contact-heading h1 {
    font-weight: 600;
    color: white;
    font-size: 3.5rem;
    line-height: 0.9;
    white-space: nowrap;
    position: relative;
    margin-bottom: 1.2rem;
}

.contact-heading h1 span {
    display: inline-block;
    border-right: 2px solid; /* Simulate cursor */
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide text initially */
}
.text{
    color: white;
    line-height: 1.1;
    font-size: 1rem;
}
.text a{
    text-decoration: underline;
    font-weight: 700;
}

.form-wrapper{
    max-width: 32rem;
}
.contact-form{
    display: grid;
    margin-top: 1.55rem;
    grid-template-columns: repeat(2, 1fr);
    column-gap:2rem;
    row-gap: 1rem;
}
.input-wrap{
    position: relative;
}
.input-wrap.w-100{
    grid-column: span 2;
}
.contact-input{
    width: 100%;
    background-color: #EAEAEA;
    padding: 1.5rem 1.35rem calc(0.75rem - 2px) 1.35rem;
    border: none;
    outline: none;
    font-family: inherit;
    border-radius: 20px;
    color: black;
    font-weight: 600;
    font-size: 0.95rem;
    box-shadow: 0 0 0 0px;
    transition: 0.3s;
}
.contact-input:hover{
    background-color: #DCE6EE;
}
.input-wrap label{
    position: absolute;
    top: 50%;
    left: calc(1.35rem + 2px);
    transform: translateY(-50%);
    color:#656565;
    pointer-events: none;
    transition: .25s;
}
.input-wrap .icon{
    position: absolute;
    right: calc(1.35rem + 2px);
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color:#646464;
    font-size: 1.25rem;
    transition: 0.3s;
}
textarea.contact-input{
    resize: none;
    width: 100%;
    min-height: 150px;
}
textarea.contact-input ~ label{
    top: 1.2rem;
    transform: none;
}
textarea.contact-input ~ .icon{
    top: 1.3rem;
    transform: none;
}
.input-wrap.focus .contact-input{
    background-color:  #EAEAEA;
    border: 2px ;
}
.input-wrap.focus label{
    color: blue;
}
.input-wrap.focus .icon{
    color: blue;
}
.input-wrap.not-empty label{
    font-size: 0.66rem;
    top: 0.75rem;
    transform: translateY(0);
}
.contact-buttons{
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap:1rem;
    margin-bottom: 50px;
    width: 100%;
    grid-column: span 2;
}
.btn{
    display: inline-block;
    padding: 1.1rem 2rem;
    background-color: blue;
    color: white;
    border-radius: 40px;
    border: 20px;
    font-family: inherit;
    font-weight: 500;
    font-size: 1rem;
    cursor: pointer;
    transition: 0.3s;
}
.btn:hover{
    background-color: blue;
}
.btn.upload{
    position: relative;
    background-color:#EAEAEA ;
    color: black;
}
.btn.upload:hover{
    color: blue;
}
.btn.upload input{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: blue;
    cursor: pointer;
    opacity: 0;
}
.back-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

</style>

<body>


        <section class="contact">
        <img  src="{{ asset('img//contact.png') }}" class="back-img"></img>

            <div class="container">

                <div class="left">
                    <div class="form-wrapper">
                    <div class="contact-heading">
                    <div class="contact-heading">
    <h1> <span id="typing-text">Let's work together!</span></h1>
                            <p class="text">Or reach us via: <a href="#">
                                Seagrass@gmail.com </a></p>
                        </div>
                        <form action="" class="contact-form">
                            <div class="input-wrap">
                                <input  class="contact-input" autocomplete="off" name="First Name" type="text" required>
                                <label>First Name</label>
                                <i class="icon fa-solid fa-address-card" ></i>
                            </div>

                            <div class="input-wrap">
                                <input  class="contact-input" autocomplete="off" name="Last Name" type="text" required>
                                <label>Last Name</label>
                                <i class=" icon fa-solid fa-address-card" ></i>
                            </div>

                            <div class="input-wrap w-100">
                                <input  class="contact-input" autocomplete="off" name="Email" type="text" required>
                                <label>Email</label>
                                <i class="icon fa fa-envelope" aria-hidden="true"></i>
                            </div>

                            <div class="input-wrap textarea w-100">
                                <textarea name="message" autocomplete="off" class="contact-input" required></textarea>
                                <label>Messages</label>
                                <i class="icon fa fa-inbox" aria-hidden="true"></i>
                            </div>
                            <div class="contact-buttons ">
                                <button class="btn upload">
                                    <span>
                                    <i class="fa fa-paperclip" aria-hidden="true"></i> Add attachement
                                    </span>
                                    <input type="file" name="attachement" >
                                </button>
                                <input type="submit" value="Send message" class="btn">
                            </div>
                        </form>
                    </div>
                </div>

        </div>
        </section>

</body>
<script>
    const inputs = document.querySelectorAll(".contact-input");

    inputs.forEach(ipt =>{
        ipt.addEventListener("focus", () =>{
            ipt.parentNode.classList.add("focus");
            ipt.parentNode.classList.add("not-empty");
        });

        ipt.addEventListener("blur", () =>{
            if (ipt.value == ""){
                ipt.parentNode.classList.remove("not-empty");
            }
            ipt.parentNode.classList.remove("focus");
        });

    });



</script>
@endsection

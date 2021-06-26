<footer id="myFooter">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h2 class="logo">
                    <a href="{{ url('/') }}">
                        <img class="img-top img-fluid" src="{{ asset('img/footer/logo.png') }}" alt="Card image cap">
                    </a>
                </h2>
            </div>
            <div class="col-sm-2">
                <h5>Nutrição</h5>
                <ul>
                    <li><a href="{{ url('menu') }}">Cardápio</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>Ramais</h5>
                <ul>
                    <li><a href="{{ url('branch') }}">Contatos</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>Setores</h5>
                <ul>
                    <li><a href="{{ url('sectors/administrative') }}">Administrativos</a></li>
                    <li><a href="{{ url('sectors/assistance') }}">Assistenciais</a></li>
                    <li><a href="{{ url('sectors/technology') }}">Suporte</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="social-networks">
                    <a href="{{ url('https://www.linkedin.com/company/hospital-gastrocl%C3%ADnica/') }}" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="{{url('https://www.facebook.com/GastroclinicaHospital/') }}" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="{{ url ('https://www.instagram.com/gastroclinicahospital/')}}" class="instagram"><i class="fa fa-instagram"></i></a>
                    <a href="{{ url('http://www.gastroclinicahospital.com.br/') }}" class="www"><i class="fa fa-globe"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p class="copy-right mx-3">© 2021 Copyright - TIC Gastroclinica</p>
    </div>
</footer>

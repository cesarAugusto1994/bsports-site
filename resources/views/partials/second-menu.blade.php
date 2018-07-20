<div class="header-action-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="newsticker" id="newsticker">
                    <div class="bn-title"><strong>Próximas Partidas:</strong><span></span></div>
                    <!--
                    <ul>
                        <li><a href="#">Vivamus sed enim vulputate lorem mattis volutpat...</a></li>
                        <li><a href="#">Quisque rhoncus sem at tristique finibus...</a></li>
                        <li><a href="#">Integer commodo ante ut tellus fringilla posuere... </a></li>
                        <li><a href="#">Suspendisse consequat magna nec tincidunt sodales...</a></li>
                        <li><a href="#">Morbi id nisl efficitur, aliquet felis ut, efficitur justo...</a></li>
                        <li><a href="#">Devin Booker drops 70 points on Celtics at </a></li>
                    </ul>
                  -->
                    <div class="bn-navi"> <span></span> <span></span> </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <ul class="acbar-right">
                    <li class="social">
                      @if(\App\Helpers\Helper::getConfig('empresa-facebook'))
                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-facebook') }}" class="fb-icon"><i class="fa fa-facebook"></i></a>
                      @endif
                      @if(\App\Helpers\Helper::getConfig('empresa-twitter'))
                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-twitter') }}" class="tw-icon"><i class="fa fa-twitter"></i></a>
                      @endif
                      @if(\App\Helpers\Helper::getConfig('empresa-google'))
                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-google') }}" class="lin-icon"><i class="fa fa-google-plus"></i></a>
                      @endif
                      @if(\App\Helpers\Helper::getConfig('empresa-vimeo'))
                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-vimeo') }}" class="lin-icon"><i class="fa fa-vimeo"></i></a>
                      @endif
                      @if(\App\Helpers\Helper::getConfig('empresa-linkedin'))
                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-linkedin') }}" class="lin-icon"><i class="fa fa-linkedin"></i></a>
                      @endif
                      @if(\App\Helpers\Helper::getConfig('empresa-youtube'))
                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-youtube') }}" class="yt-icon"><i class="fa fa-youtube"></i></a>
                      @endif
                    </li>
                    <li>
                        <div class="dropdown">
                            <button type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="./images/eng.jpg" alt="" /> ENG </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="#"><img src="./images/eng.jpg" alt="" /> AR</a>
                                </li>
                                <li>
                                    <a href="#"><img src="./images/eng.jpg" alt="" /> FR</a>
                                </li>
                                <li>
                                    <a href="#"><img src="./images/eng.jpg" alt="" /> ENG</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if(\App\Helpers\Helper::getConfig('pagina-regulamento'))

                      <li>
                          <a href="{{ \App\Helpers\Helper::getConfig('pagina-regulamento') }}" class="login-btn"> <i class="fa fa-file-0"></i> Regularmento</a>
                      </li>

                    @endif
                    <li>
                        <a href="{{ route('agendar_partida') }}" class="login-btn"> <i class="fa fa-calendar-o"></i> Agendamento</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin') }}" class="login-btn"> <i class="fa fa-user"></i> Área do Jogador</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

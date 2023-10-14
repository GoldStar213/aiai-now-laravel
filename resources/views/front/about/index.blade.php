@extends('layouts.front', [ 'body_class' => 'about'])

@section('content')
<div class="about-area">
    <section id="lead" class="lead">
        <div class="wrap">
            <div class="lead-head">
                <h3 class="lead-head-ttl">
                    AIAI-NOWとは？
                    <img src="{{ asset('img/about/ttl.png') }}" alt="" />
                </h3>
                <p class="sec-ttl-sub">
                    世界のAIサービスをいち早く紹介する<br class="br-480">まとめサイトです。
                </p>
                <p class="lead-head-txt">
                    代行申請や翻訳など<br>
                    ご要望に応じた依頼も承ります。
                </p>
            </div>

            <h4 class="block-ttl">サービス情報</h4>
            <div class="services">
                <img src="{{ asset('img/about/services.png') }}" alt="" />
            </div>

            <div class="figure-list">
                <div class="figure-item">
                    <img src="{{ asset('img/about/service-figure-01.jpg') }}" alt="" />
                </div>

                <div class="figure-item">
                    <img src="{{ asset('img/about/service-figure-02.jpg') }}" alt="" />
                </div>

                <div class="figure-item">
                    <img src="{{ asset('img/about/service-figure-03.jpg') }}" alt="" />
                </div>
            </div>
        </div>
    </section>

    <section id="search" class="search">
        <div class="wrap">
            <h3 class="sec-ttl">探す</h3>
            <p class="sec-ttl-sub">様々な条件からサービスを探せます。</p>
            
            <div class="searches">
                <img src="{{ asset('img/about/searches.png') }}" alt="" />
            </div>
        </div>
    </section>

    <section id="orders" class="orders">
        <div class="wrap">
            <h3 class="sec-ttl">代行依頼する</h3>

            <div class="orders-lead">
                <img src="{{ asset('img/about/orders-lead.png') }}" alt="" />
            </div>

            <div class="orders-list">
                <a class="orders-item btn-contact">
                    <div class="orders-item-wrapper">
                        <div class="orders-item-inner">
                            <div class="orders-item-icon">
                                <img src="{{ asset('img/about/orders-01.png') }}" alt="" />
                            </div>
                            <p class="orders-item-text">
                                海外のサービスに<br>
                                代わりに申請して<br>
                                欲しい！
                            </p>
                            <div class="orders-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </a>

                <a class="orders-item" href="{{ route('front.contact.index') }}?type=1">
                    <div class="orders-item-wrapper">
                        <div class="orders-item-inner">
                            <div class="orders-item-icon">
                                <img src="{{ asset('img/about/orders-02.png') }}" alt="" />
                            </div>
                            <p class="orders-item-text">
                                希望するAIサービスを<br>
                                リサーチして<br>
                                欲しい！
                            </p>
                            <div class="orders-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </a>

                <a class="orders-item btn-contact">
                    <div class="orders-item-wrapper">
                        <div class="orders-item-inner">
                            <div class="orders-item-icon">
                                <img src="{{ asset('img/about/orders-03.png') }}" alt="" />
                            </div>
                            <p class="orders-item-text">
                                英語が分からない。<br>
                                翻訳して欲しい！
                            </p>
                            <div class="orders-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </a>

                <a class="orders-item" href="{{ route('front.contact.index') }}?type=0">
                    <div class="orders-item-wrapper">
                        <div class="orders-item-inner">
                            <div class="orders-item-icon">
                                <img src="{{ asset('img/about/orders-04.png') }}" alt="" />
                            </div>
                            <p class="orders-item-text">
                                使い方を<br>
                                教えて欲しい！<br>
                                （マニュアル作成可）
                            </p>
                            <div class="orders-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </a>

                <a class="orders-item" href="{{ route('front.contact.index') }}?type=2">
                    <div class="orders-item-wrapper">
                        <div class="orders-item-inner">
                            <div class="orders-item-icon">
                                <img src="{{ asset('img/about/orders-05.png') }}" alt="" />
                            </div>
                            <p class="orders-item-text">
                                制作会社を<br>
                                探して欲しい！<br>
                                （制作相談）
                            </p>
                            <div class="orders-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>                    
                </a>
            </div>
        </div>
    </section>

    <section id="company" class="company">
        <div class="wrap">
            <h3 class="sec-ttl">法人向けサービス</h3>

            <div class="company-lead">
                <img src="{{ asset('img/about/company-lead.png') }}" alt="" />
            </div>

            <div class="company-list">
                <div class="company-item">
                    <div class="company-item-wrapper">
                        <div class="company-item-inner">
                            <div class="company-item-icon">
                                <img src="{{ asset('img/about/company-01.png') }}" alt="" />
                            </div>
                            <p class="company-item-text">
                                定期便として<br>
                                世界の競合リサーチや<br>
                                ご要望のAIサービス<br>
                                情報をお届けします。
                            </p>
                            <div class="company-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="company-item">
                    <div class="company-item-wrapper">
                        <div class="company-item-inner">
                            <div class="company-item-icon">
                                <img src="{{ asset('img/about/company-02.png') }}" alt="" />
                            </div>
                            <p class="company-item-text">
                                同じようなサービスを<br>
                                制作して欲しい。<br>
                                制作会社を探して<br>
                                欲しい。
                            </p>
                            <div class="company-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="company-item">
                    <div class="company-item-wrapper">
                        <div class="company-item-inner">
                            <div class="company-item-icon">
                                <img src="{{ asset('img/about/company-03.png') }}" alt="" />
                            </div>
                            <p class="company-item-text">
                                自社開発の<br>
                                AIサービスを<br>
                                宣伝したい。
                            </p>
                            <div class="company-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="company-item">
                    <div class="company-item-wrapper">
                        <div class="company-item-inner">
                            <div class="company-item-icon">
                                <img src="{{ asset('img/about/company-04.png') }}" alt="" />
                            </div>
                            <p class="company-item-text">
                                競合AIアプリの<br>
                                解析をして欲しい。
                            </p>
                            <div class="company-item-arrow">
                                <img src="{{ asset('img/about/arrow.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="member" class="member">
        <div class="wrap">
            <h3 class="sec-ttl">会員登録</h3>

            <div class="member-list-wrapper">
                <div class="member-list">
                    <div class="member-item-large">
                        <div class="member-item-large-wrapper">
                            <div class="member-item-large-fig">
                                <img src="{{ asset('img/about/member-01.png') }}" alt="" />
                            </div>
                            <div class="member-item-large-txt">
                                申請
                                <span class="star"><img src="{{ asset('img/about/member-star.png') }}" alt="" /></span>
                                <span class="text">
                                    様々なご要望を代行します<br>
                                    ・登録の申請<br>
                                    ・サービスのリサーチ<br>
                                    　etc...
                                </span>
                                <span class="arrow"><img src="{{ asset('img/about/member-arrow.png') }}" alt="" /></span>
                            </div>
                        </div>
                    </div>

                    <div class="member-item">
                        <div class="member-item-wrapper">
                            <div class="member-item-inner">
                                <p class="member-item-txt">
                                    お気に入りの<br>
                                    サービスを<br>
                                    登録できる
                                </p>
                                <div class="member-item-ico">
                                    <img src="{{ asset('img/about/member-02.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="member-item">
                        <div class="member-item-wrapper">
                            <div class="member-item-inner">
                                <p class="member-item-txt">
                                    各サービスへの<br>
                                    コメント評価が<br>
                                    できる
                                    <span class="star"><img src="{{ asset('img/about/member-star.png') }}" alt="" /></span>
                                </p>
                                <div class="member-item-ico">
                                    <img src="{{ asset('img/about/member-03.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="member-item">
                        <div class="member-item-wrapper">
                            <div class="member-item-inner">
                                <p class="member-item-txt">
                                    制作依頼
                                    <span class="star"><img src="{{ asset('img/about/member-star.png') }}" alt="" /></span>
                                </p>
                                <div class="member-item-ico">
                                    <img src="{{ asset('img/about/member-04.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="member-item">
                        <div class="member-item-wrapper">
                            <div class="member-item-inner">
                                <p class="member-item-txt">
                                    法人向け<br>
                                    サービス
                                    <span class="star"><img src="{{ asset('img/about/member-star.png') }}" alt="" /></span>
                                </p>
                                <div class="member-item-ico">
                                    <img src="{{ asset('img/about/member-05.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('register') }}" class="member-list-btn">
                    会員登録
                </a>
            </div>
        </div>
    </section>
</div>

<div id="contact-modal">
    <div id="contact-modal-box">
        <div class="contact-modal-box-header">
            <p class="contact-modal-box-header-ttl">AIAI-NOW</p>
            <a id="contact-modal-box-close"></a>
        </div>
        <div class="contact-modal-box-body">
            <p class="contact-modal-box-txt">申請代行相談や翻訳相談は<br>個別のサービス画面で出来ます。</p>
            <a class="btn-to-service-list" href="{{ route('front.services.index') }}">サービスを探す</a>
        </div>
    </div>
</div>
@stop

@section('footer_script')
<script>
$(function() {
});
</script>
@stop
<div class="standard-box">
    <div id="tabs">
        <ul class="nav nav-pills nav-fill" style="margin-bottom: 20px;">
            <li class="nav-item"><a id="link-tab1" class="nav-item nav-link" href="#tabs-1">Vos cartes</a></li>
            <li class="nav-item"><a id="link-tab2" class="nav-item nav-link" href="#tabs-2">Tableau</a></li>
            <li class="nav-item"><a id="link-tab3" class="nav-item nav-link" href="#tabs-3">Cartes <?= $this->aCardsConf['Packs'][1]['Nom'];?></a></li>
        </ul>
        <div id="tabs-1" style="text-align: center;">
            <div class="ajax-loader d-flex justify-content-center" style="display: none !important;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div id="tabs-2" style="text-align: center;">
            <div class="ajax-loader d-flex justify-content-center" style="display: none !important;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div id="tabs-3" style="text-align: center;">
            <div class="ajax-loader d-flex justify-content-center" style="display: none !important;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/tab.js"></script>
<script type="text/javascript" src="/js/ajax/load-collection.js"></script>
<script type="text/javascript" src="/js/ajax/load-table.js"></script>
<script type="text/javascript" src="/js/ajax/load-packs.js"></script>
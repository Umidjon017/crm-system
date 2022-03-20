<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => Yii::t('ui', 'Dashboard'), 'url' => ['/site/index'], 'icon' => 'home'],
                    ['label' => Yii::t('ui', 'References'), 'icon' => 'folder', 'items' => [
                        ['label' => Yii::t('ui', 'Teacher'), 'icon' => 'file', 'url' => '/admin/catalog/teacher/index'],
                        ['label' => Yii::t('ui', 'Subject'), 'icon' => 'file', 'url' => '/admin/catalog/subject/index'],
                        ['label' => Yii::t('ui', 'Pupil'), 'icon' => 'file', 'url' => '/admin/catalog/pupil/index'],
                        ['label' => Yii::t('ui', 'Room'), 'icon' => 'file', 'url' => '/admin/catalog/room/index'],
                    ]],
                    ['label' => Yii::t('ui', 'Payment'), 'icon' => 'money', 'items' => [
                        ['label' => Yii::t('ui', 'Payment'), 'icon' => 'file-o', 'url' => '/admin/payment/payment/index'],
                        ['label' => Yii::t('ui', 'Income'), 'icon' => 'file-o', 'url' => '/admin/payment/payment/index?PaymentSearch%5Bname%5D=&PaymentSearch%5Bamount%5D=&PaymentSearch%5Bdate%5D=&PaymentSearch%5Btype%5D=1&PaymentSearch%5Bstatus%5D='],
                        ['label' => Yii::t('ui', 'Outcome'), 'icon' => 'file-o', 'url' => '/admin/payment/payment/index?PaymentSearch%5Bname%5D=&PaymentSearch%5Bamount%5D=&PaymentSearch%5Bdate%5D=&PaymentSearch%5Btype%5D=0&PaymentSearch%5Bstatus%5D='],
                    ]],
                    ['label' => Yii::t('ui', 'Notification'), 'icon' => 'folder', 'items' => [
                        ['label' => Yii::t('ui', 'Notification'), 'icon' => 'file-o', 'url' => '/admin/notification/notification/index'],
                    ]],
                    ['label' => Yii::t('ui', 'Settings'), 'icon' => 'cogs', 'items' => [
                        [
                            'label' => Yii::t('ui', 'Translations'),
                            'url' => ['/settings/source-message/list'],
                            'icon' => 'language'
                        ],
                        [
                            'label' => Yii::t('ui', 'Gii'), 'icon' => 'file-o', 'url' => '/gii'
                        ],
                    ]],
                ],
            ]
        ) ?>

    </section>

</aside>

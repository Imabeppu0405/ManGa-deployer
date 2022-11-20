# ManGa-deployer
## deploy実行
```
vendor/bin/dep deploy ManGa
```

## rollback時（migrationなし）
```
vendor/bin/dep rollback
```

## rollback時（migratiionあり）
```
vendor/bin/dep artisan:migrate:rollback
vendor/bin/dep rollback
```
## deployの中身
1. deploy:info
    - deploy情報の画面表示
1. deploer:setup
    - ホストへの接続（ここでつまる場合は、host名等が異なる可能性が高い）
1. deplpy:lock
    - 他のdeployとブッキングしないように、ロックする。（deployが強制終了してしまった場合などは、下記で解除できる）
    ```
    vendor/bin/dep deploy:unlock
    ```
1. deploy:release
    - デプロイするソースコードを配置するためのディレクトリを整備
1. deoloy:update_code
    - git cloneでコードをとってくる
1. deploy:shared
    - 共有ディレクトリを配置
1. deploy:writable
    - 書き換えディレクトリを配置
1. deploy:vandors
    - vendorsのインストール（composer install）
1. artisan:storage:link
    - シンボリックリンクの作成
1. artisan:config:cache
    - 設定ファイルのキャッシュ作成
1. artisan:route:cache
    - ルーティングのキャッシュ作成
1. artisan:view:cache 
    - bladeファイルのキャッシュ作成
1. artisan:event:cache 
    - イベント（特定のイベントが発火すると、それに対応したコールバックを実行する仕組み）のキャッシュ作成
1. artisan:migrate 
    - migrationの実行
1. deploy:symlink 
    - シンボリックリンクの差し替え
1. deploy:unlock 
    - deploy:lockの解除
1. deploy:cleanup
    - 前リリースバージョンを削除

## Tips
### taskの追加方法
```
// タスクの設定
task('build', function() {
    run('cd /var/www/current; npm run build');
});

// どのタイミングでタスクを実行するか
after('deploy', 'build');
```

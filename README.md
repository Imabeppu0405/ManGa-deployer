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

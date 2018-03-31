
1. PHP解决多线程写一个文件的问题

定义和用法
flock() 函数锁定或释放文件。

若成功，则返回 true。若失败，则返回 false。

flock() 操作的 file 必须是一个已经打开的文件指针。

lock 参数可以是以下值之一：
要取得共享锁定（读取的程序），将 lock 设为 LOCK_SH（PHP 4.0.1 以前的版本设置为 1）。
要取得独占锁定（写入的程序），将 lock 设为 LOCK_EX（PHP 4.0.1 以前的版本中设置为 2）。
要释放锁定（无论共享或独占），将 lock 设为 LOCK_UN（PHP 4.0.1 以前的版本中设置为 3）。
如果不希望 flock() 在锁定时堵塞，则给 lock 加上 LOCK_NB（PHP 4.0.1 以前的版本中设置为 4）。

<?php
$fp = fopen("test.txt", "a");
if(flock($fp, LOCK_EX)){
    fwite($fp, "write some");
    flock($fp, LOCK_UN);
    fclose($fp);
}else{
    echo "locking";
}

##git常用操作总结
###恢复文件
- 恢复到最后一次提交的改动，没有add到暂存队列
<pre><code>git checkout -- + 需要恢复的文件名</code></pre>
- 如果已经add到暂存队列，需要先让这个文件取消暂存
<pre><code>git reset HEAD -- + 需要取消暂存的文件名</code></pre>
执行此命令后，需要再次执行上述git checkout



	

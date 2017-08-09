## git常用操作总结

### 创建版本库

	$ mkdir myapp 			创建一个空目录
	$ cd myapp				切换到该目录
	$ git init				创建仓库，并生成.git文件，ls -ah可查看
### 提交文件

	$ git add readme.txt	把readme.txt添加到本地仓库
	$ git commit -m "some"	提交到本地仓库，-m是提交说明
	---------------------------------------------------------------------------------
	$ git add . 			在添加多个文件时，可直接执行
### 查看状态

	$ git status 			查看当前仓库的状态
	$ git diff readme.txt 	查看readme.txt本次与上次的差异
### 版本回滚

	$ git log 						查看仓库提交的版本历史，详细
	$ git log --pretty=oneline 		查看仓库提交的版本历史，精简一行
	$ git reset --hard HEAD^		HEAD^表示返回上个版本，HEAD^^上上个版本，上面第100个版本可写成HEAD~100
	$ git reset --hard commitid		commitid表示提交的id，git log可查看
	$ git reflog 					查看每一次的操作命令
### 撤销修改

	$ git checkout -- readme.txt 	撤销readme.txt在工作区的全部修改，（提交到暂存区之前）
	$ git reset HEAD readme.txt		撤销readme.txt暂存区的全部修改，再撤销工作区，（add之后，commit之前）
	$ commit之后，可参考版本回滚
### 删除文件

	$ git rm readme.txt 删除一个readme.txt文件，如果从版本库中删除commit即可，如果是工作区误删除，git checkout -- readme.txt还原即可
### 远程仓库

	$ git push 
	$ git pull 
	$ git clone



​	

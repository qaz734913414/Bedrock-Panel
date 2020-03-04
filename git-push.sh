#!/bin/bash
echo ==================
git add .
echo 已完成记录更新文件
echo ==================
git commit -m $1
echo 已把代码交到本地库
git push
echo ==================
echo 已完成代码提交任务
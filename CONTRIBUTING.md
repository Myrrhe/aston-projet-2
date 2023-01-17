How to create a new branch :
- When you are on develop, enter `git checkout branch-name`

How to merge a branch :
- First, rebase your branch according to the **develop** branch : `git checkout rebase origin/develop`
- Next, push your branch on the remote repository : `git push origin branch-name` (if the rebasing was necessary, you may need to enter `git push --force-with-lease origin branch-name`)
- Go on Github, and create a Pull Request (Github should automaticcaly ask you if you want to create one).
- Your branch will be merged after is has been reviewed

Recommended :
- Please avoid leaving warning by the IDE when you can avoid them.
- Also, if possible, configure your IDE to not be too lenient, so others won't have warnings appear when they use your work.

#/bin/bash
GITHUB_ACCOUNT="zither"
GITHUB_REPO="zither.github.com"
GITHUB_BRANCH="master"

git clone "https://github.com/$GITHUB_ACCOUNT/$GITHUB_REPO"
cd "$GITHUB_REPO"
git checkout "$GITHUB_BRANCH"

if [ -d "$HOME/.pointless2" ];
then 
    rm -rf "$HOME/.pointless2/Blog/Markdown/*"
    #[[ -d "$HOME/Markdown" ]] || mkdir "$HOME/Markdown"
    cd ".."
    echo "Start Sync Markdown Files... "
    cp -r "$GITHUB_REPO/Markdown/" "$HOME/.pointless2/Blog/"
else 
    echo "Before Synchronize, You must init Pointless."
    exit
fi

echo "Sync completed."

name: Build and Release

on:
  push:
    tags:
      - '[0-9]+'  # Matches single-digit tags like 1, 2, 3, etc.
      - '[0-9]+\.[0-9]+'  # Matches tags like 1.0, 1.1, 2.0, etc.
      - '[0-9]+\.[0-9]+\.[0-9]+'  # Matches tags like 1.0.0, 1.0.1, 2.0.0, etc.

jobs:
  dist:
    name: "Build distribution release."
    runs-on: ubuntu-latest

    steps:
      - name: "Checks out the repository."
        uses: "actions/checkout@v2"

      - name: "Setup NodeJS."
        uses: actions/setup-node@v2
        with:
          node-version: '20'  # Use the latest LTS version of Node.js

      - name: "Install NPM dependencies"
        run: |
          if [ -f package.json ]; then
            npm install
          fi

      - name: "Build release: Stable"
        run: npm run build

      - name: "Copy files to distribution directory excluding .distignore entries"
        run: |
          mkdir -p dist
          rsync -a --delete --exclude-from='.distignore' ./ dist/

      - name: "Create a Release Archive"
        run: |
          cd dist
          zip -r ../test.zip .

      - name: "Debug: List Distribution Directory"
        run: ls -la dist

      - name: "Create a GitHub Release"
        uses: softprops/action-gh-release@v1
        with:
          files: test.zip
        env:
          GITHUB_TOKEN: ${{ secrets.SELFHOST_TOKEN }}  # Ensure this token has the right permissions
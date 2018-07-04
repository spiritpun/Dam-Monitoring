module.exports = {
  "parser": "babel-eslint",
  "extends": "airbnb",
  "env": {
    "browser": true,
    "es6": true
  },
  "plugins": [
    "react",
    "jsx-a11y"
  ],
  "parserOptions": {
    "ecmaVersion": 6,
    "sourceType": "module",
    "ecmaFeatures": {
      "jsx": true
    }
  },
  "rules": {
    "arrow-parens": 0,
    "arrow-body-style": [
      2,
      "as-needed"
    ],
    "comma-dangle": [
      2,
      "always-multiline"
    ],
    "import/extensions": 0,
    "import/imports-first": 0,
    "import/newline-after-import": 0,
    "import/no-dynamic-require": 0,
    "import/no-extraneous-dependencies": 0,
    "import/no-named-as-default": 0,
    "import/no-duplicates": 0,
    "import/no-unresolved": [2, { "ignore": ["^[~]"] }],
    "import/prefer-default-export": 0,
    "indent": [
      2,
      2,
      {
        "SwitchCase": 1
      }
    ],
    "jsx-a11y/aria-props": 2,
    "jsx-a11y/heading-has-content": 0,
    "jsx-a11y/href-no-hash": 0,
    "jsx-a11y/anchor-is-valid": 0,
    "jsx-a11y/label-has-for": 1,
    "jsx-a11y/mouse-events-have-key-events": 2,
    "jsx-a11y/role-has-required-aria-props": 2,
    "jsx-a11y/role-supports-aria-props": 2,
    "max-len": 0,
    "newline-per-chained-call": 0,
    "no-confusing-arrow": 0,
    "no-console": 0,
    "no-case-declarations": 0,
    "no-use-before-define": 0,
    "prefer-template": 2,
    "class-methods-use-this": 0,
    "quote-props": ["error", "consistent"],
    "react/forbid-prop-types": 0,
    "react/prop-types": 0,
    "linebreak-style": 0,
    "object-curly-newline": 0,
    "react/jsx-first-prop-new-line": [
      2,
      "multiline"
    ],
    "react/jsx-filename-extension": 0,
    "react/jsx-no-target-blank": 0,
    "react/require-extension": 0,
    "react/self-closing-comp": 0,
    "require-yield": 0,
    "import/no-webpack-loader-syntax": 0,
    "no-underscore-dangle": 0,
    "no-param-reassign": [2, { "props": false }],
    "react/prefer-stateless-function": 0,
    "no-lonely-if": 0
  },
  "settings": {
    "import/resolver": {
      "babel-root-import": {},
      "webpack": {
        "config": "./internals/webpack/webpack.prod.babel.js"
      }
    },
    "import/parser": "babel-eslint"
  }
}

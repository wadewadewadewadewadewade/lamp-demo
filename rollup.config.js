import resolve from "@rollup/plugin-node-resolve";
//import tscc from '@tscc/rollup-plugin-tscc';
import typescript from '@rollup/plugin-typescript';
import { terser } from 'rollup-plugin-terser';
//import sass from 'rollup-plugin-sass';
import scss from './index.es.js';
import commonjs from '@rollup/plugin-commonjs';
import tsconfig from './tsconfig.json';

export default {
    input: 'src/app.ts',
    output: {
        file: 'build/bundle.js',
        format: 'iife',
        globals: {
            'jquery': '$'
        }
    },
    external: ['jquery'],
    plugins: [
        //tscc(),
        terser(),
        resolve({
            browser: true
        }), // So rollup can find imports
        commonjs(), // Convert to an ES module
        typescript({
            ...tsconfig.compilerOptions,
            include: '**/*.{js,ts}'
        }),
        scss({
            include: './src/**/*.scss',
            output: './build/bundle.css'
        })
    ]
}
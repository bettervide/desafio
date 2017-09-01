select departamento.dept_name as Nome_Departamento, concat(funcionario.first_name,' ',funcionario.last_name) as Nome_Completo, DATEDIFF(departamento_funcionario.to_date, departamento_funcionario.from_date) as Dias_Trabalhados from employees as funcionario
join dept_emp as departamento_funcionario on funcionario.emp_no = departamento_funcionario.emp_no
join departments as departamento on departamento_funcionario.dept_no = departamento.dept_no 
where dept_name = 'Development' 
order by Dias_Trabalhados desc
limit 10;

export interface MetApiResponse {
  benchmark: number
  status: 'success' | 'failure'
  query: {
    options: Record<string, any>
    params: Record<string, any>
  }
  paginate?: {
    current_page: number
    first_item: number
    last_item: number
    last_page: number
    pages: Array<number>
    per_page: number
    total: number
  }
  data: any
}

export interface User {
  id:number
  name: string
  email: string
  job_title:string
  mobile_no:string
  github_profile:string
  linkedin_profile:string
  location:string
  description:Text
}

export interface Skill {
  id:number
  name: string
}

export interface Education {
  id:number
  degree_name: string
  university_name:string
  from_date:Date
  to_date:Date
}

export interface Language {
  id:number
  language_name:string
}

export interface Hobby {
  id:number
  hobby_name:string
}

export interface Experience {
  id:number
  company_name:string
  job_title:string
  from_date:Date
  to_date:Date
  responsibilities:Text
}

export interface LoginForm {
  username:string
  password:string
}

export interface CreateAccount {
  name:string
  email:string
  mobile_no:string
  job_title:string
  location:string
  password:string
}

export type Users = Array<User>
